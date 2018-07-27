<?php

namespace App\Controller;

use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;


/**
 * Class SecurityController
 * @package App\Controller
 *
 * @Route("/")
 */
class SecurityController extends Controller
{

    /**
     * @Route("/login")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function login(Request $request)
    {

        $connect = $this->container->getParameter('hwi_oauth.connect');
        $hasUser = $this->getUser() ? $this->isGranted($this->container->getParameter('hwi_oauth.grant_rule')) : false;

        $error = $this->getErrorForRequest($request);

        // if connecting is enabled and there is no user, redirect to the registration form
        if ($connect && !$hasUser && $error instanceof AccountNotLinkedException) {
            $key = time();
            $session = $request->getSession();
            $session->set('_hwi_oauth.registration_error.' . $key, $error);

            return $this->redirectToRoute('hwi_oauth_connect_registration', ['key' => $key]);
        }

        if ($error) {
            if ($error instanceof AuthenticationException) {
                $error = $error->getMessageKey();
            } else {
                $error = $error->getMessage();
            }
        }

        return $this->render(
            'login.html.twig',
            [
                'error' => $error,
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return string|\Exception
     */
    protected function getErrorForRequest(Request $request)
    {
        $authenticationErrorKey = Security::AUTHENTICATION_ERROR;

        $session = $request->getSession();
        if ($request->attributes->has($authenticationErrorKey)) {
            $error = $request->attributes->get($authenticationErrorKey);
        } elseif (null !== $session && $session->has($authenticationErrorKey)) {
            $error = $session->get($authenticationErrorKey);
            $session->remove($authenticationErrorKey);
        } else {
            $error = '';
        }

        return $error;
    }
}
