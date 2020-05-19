<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 14/01/19
 * Time: 23:10
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class AfterLoginRedirection
 *
 * @package AppBundle\AppListener
 */
class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    /**
     * AfterLoginRedirection constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request        $request
     *
     * @param TokenInterface $token
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_ADMIN', $rolesTab, true)) {
            // c'est un aministrateur : on le redirige vers l'espace admin
            $redirection = new RedirectResponse($this->router->generate('admin_dashboard'));
        } elseif(in_array('ROLE_FARMER', $rolesTab, true)) {
            // c'est un farmer : on le redirige vers le dashboad farmer
            $redirection = new RedirectResponse($this->router->generate('farmer_products'));
        } else {
        // c'est un utilisaeur lambda : on le rediriger vers l'accueil
        $redirection = new RedirectResponse($this->router->generate('consumer'));
    }

        return $redirection;
    }
}