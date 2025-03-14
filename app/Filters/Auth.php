<?php namespace App\Filters;

      use CodeIgniter\Filters\FilterInterface;
      use CodeIgniter\HTTP\RequestInterface;
      use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(! session()->get('loginstatus'))
        {
            return redirect()->to('/loginadministrator');
        }
    }

    public function after(RequestInterface $reques, ResponseInterface $response, $arguments = null)
    {
        //do something here
    }
}