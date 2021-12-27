<?php

namespace Modules\Export\Multions;

use App\Exports\UsersExport;
use App\Multions\MultionInterface;
use App\Multions\MultionTrait;
use Modules\Export\Repositories\UserRepository;

class UserMultion implements MultionInterface
{
    /**
     * Trait Multion
     */
    use MultionTrait;

    /**
     * @var UserRepository
     */
    protected $userRepository;
    protected $usersExport;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository    = $userRepository;
    }

    public function instanceUserExport($users, $type = 'Xls')
    {
        return new UsersExport($users, $type);
    }
}
