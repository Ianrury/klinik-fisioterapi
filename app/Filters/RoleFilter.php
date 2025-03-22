<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = auth(); // Get the Shield auth instance
        $user = $auth->user(); // Get the currently logged-in user

        if (!$user) {
            // If no user is logged in, redirect to the login page
            return redirect()->to('/login');
        }

        // Check if the user is in the 'admin' group
        if (in_array('admin', $arguments) && !$user->inGroup('admin')) {
            // If user is not in admin group, deny access and redirect to home
            return redirect()->to('/');
        }

        // Check if the user is in the 'fisioterapis' group
        if (in_array('fisioterapis', $arguments) && !$user->inGroup('fisioterapis')) {
            // If user is not in fisioterapis group, deny access and redirect to home
            return redirect()->to('/');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
