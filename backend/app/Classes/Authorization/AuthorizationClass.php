<?php

namespace App\Classes\Authorization;

use Dlnsk\HierarchicalRBAC\Authorization;
use App\Traits\RolesGet;

/**
 *  This is example of hierarchical RBAC authorization configiration.
 */
class AuthorizationClass extends Authorization
{
    /**
     * @return \string[][]
     */
    public function getPermissions(): array
    {
        $data = [];
        $roles = RolesGet::getRoles();

        foreach ($roles as $slug => $role) {
            $data[$slug] = [];
            foreach ($role->permissions as $permission) {
                $key = RolesGet::slug($permission->slug);
                $data[$slug][$key] = [
                    'description' => $permission->name
                ];
            }
        }

        return $data;

//        return [
//            'update-post' => [
//                // Необязательное свойство "описание"
//                'description' => 'Редактирование любых статей',
//                // Используется для создания цепи (иерархии) операций
//                'next' => 'update-post-in-category',
//            ],
//            'update-post-in-category' => [
//                'description' => 'Редактирование статей в определенной категории',
//                'next' => 'update-own-post',
//            ],
//            'update-own-post' => [
//                'description' => 'Редактирование собственных статей',
//                // Здесь цепь заканчивается
//            ],
//            // Избранное
//            'add-to-favorites' => [
//                'description' => 'Добавление статьи в список избранных',
//            ],
//            // Удаление
//            'delete-post' => [
//                'description' => 'Удаление статей',
//                'equal' => 'update-post',  // Применяем правила аналогичные редактированию
//            ],
//        ];
    }

    /**
     * @return \string[][]
     */
    public function getRoles(): array
    {
        $data = [];
        $roles = RolesGet::getRoles();

        foreach ($roles as $slug => $role) {
            $data[$slug] = [];
            foreach ($role->permissions as $permission) {
                $data[$slug][] = RolesGet::slug($permission->slug);
            }
        }

        return $data;

//        return [
//            'superadmin' => [
//                'update-post',
//                'delete-post',
//            ],
//            'manager' => [
//                'update-post',
//                'delete-post',
//            ],
//            'organization' => [
//                'update-post-in-category',
//            ],
//            'provider' => [
//                'update-own-post',
//                'add-to-favorites',
//                'delete-post',
//            ],
//            'company' => [
//                'update-post',
//                'delete-post',
//            ],
//            'employee' => [
//                'update-post',
//                'delete-post',
//            ]
//        ];
    }


    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $manager
     * @param $permission
     * @return bool
     */
    public function readOwnManager($user, $manager, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $manager->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $manager
     * @param $permission
     * @return bool
     */
    public function viewOwnManager($user, $manager, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $manager->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $manager
     * @param $permission
     * @return bool
     */
    public function editOwnManager($user, $manager, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $manager->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $manager
     * @param $permission
     * @return bool
     */
    public function updateOwnManager($user, $manager, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $manager->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $organization
     * @param $permission
     * @return bool
     */
    public function readOwnOrganization($user, $organization, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $organization->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $organization
     * @param $permission
     * @return bool
     */
    public function viewOwnOrganization($user, $organization, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $organization->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $organization
     * @param $permission
     * @return bool
     */
    public function editOwnOrganization($user, $organization, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $organization->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $organization
     * @param $permission
     * @return bool
     */
    public function updateOwnOrganization($user, $organization, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $organization->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $provider
     * @param $permission
     * @return bool
     */
    public function readOwnProvider($user, $provider, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $provider->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $provider
     * @param $permission
     * @return bool
     */
    public function viewOwnProvider($user, $provider, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $provider->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $provider
     * @param $permission
     * @return bool
     */
    public function editOwnProvider($user, $provider, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $provider->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $provider
     * @param $permission
     * @return bool
     */
    public function updateOwnProvider($user, $provider, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $provider->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $company
     * @param $permission
     * @return bool
     */
    public function readOwnCompany($user, $company, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $company->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $company
     * @param $permission
     * @return bool
     */
    public function viewOwnCompany($user, $company, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $company->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $company
     * @param $permission
     * @return bool
     */
    public function editOwnCompany($user, $company, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $company->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $company
     * @param $permission
     * @return bool
     */
    public function updateOwnCompany($user, $company, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $company->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $employee
     * @param $permission
     * @return bool
     */
    public function readOwnEmployee($user, $employee, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $employee->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $employee
     * @param $permission
     * @return bool
     */
    public function viewOwnEmployee($user, $employee, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $employee->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $employee
     * @param $permission
     * @return bool
     */
    public function editOwnEmployee($user, $employee, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $employee->id;
    }

    /**
     * Methods which checking permissions.
     * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $employee
     * @param $permission
     * @return bool
     */
    public function updateOwnEmployee($user, $employee, $permission): bool
    {
        // This is a helper method for getting the model if $post is id
        // $post = $this->getModel(\App\Post::class, $post);
        if ($user->isArchived()) {
            return false;
        }
        return $user->id === $employee->id;
    }

    /**
     * @param $user
     * @param $post
     * @param $permission
     * @return bool
     * @throws \Exception
     */
//    public function updatePostInCategory($user, $post, $permission): bool
//    {
//        // Данный метод возвращает модель в случае, если $post содержит id модели
//        $post = $this->getModel(\App\Post::class, $post);
//
//        return $user->category_id === $post->category_id;
//    }
}
