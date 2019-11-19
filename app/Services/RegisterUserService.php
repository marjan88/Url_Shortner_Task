<?php
/**
 * Created by PhpStorm.
 * User: mvaradjanin
 * Date: 18.11.19.
 * Time: 21.33
 */

namespace App\Services;


use App\Repositories\Contracts\UserRepository;

class RegisterUserService extends AbstractService {

    protected $userRepository;

    /**
     * RegisterUserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function handle() {
        $request          = $this->getRequest();
        $data             = $request->only(['name', 'email', 'password']);
        $data['password'] = app('hash')->make($data['password']);

        return $this->userRepository->create($data);
    }

}
