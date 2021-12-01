<?php

namespace App\Classes\Authorization;

use Dlnsk\HierarchicalRBAC\Authorization;

/**
 *  This is example of hierarchical RBAC authorization configiration.
 */
class AuthorizationClass extends Authorization
{
    /**
     * @return \string[][]
     */
    public function getPermissions()
    {
        return [
            'update-post' => [
                // Необязательное свойство "описание"
                'description' => 'Редактирование любых статей',
                // Используется для создания цепи (иерархии) операций
                'next' => 'update-post-in-category',
            ],
            'update-post-in-category' => [
                'description' => 'Редактирование статей в определенной категории',
                'next' => 'update-own-post',
            ],
            'update-own-post' => [
                'description' => 'Редактирование собственных статей',
                // Здесь цепь заканчивается
            ],
            // Избранное
            'add-to-favorites' => [
                'description' => 'Добавление статьи в список избранных',
            ],
            // Удаление
            'delete-post' => [
                'description' => 'Удаление статей',
                'equal' => 'update-post',  // Применяем правила аналогичные редактированию
            ],
        ];
    }

    /**
     * @return \string[][]
     */
    public function getRoles() {
        return [
            'admin' => [
                'update-post',
                'delete-post',
            ],
            'manager' => [
                'update-post-in-category',
            ],
            'user' => [
                'update-own-post',
                'add-to-favorites',
                'delete-post',
            ],
        ];
    }


	/**
	 * Methods which checking permissions.
	 * Methods should be present only if additional checking needs.
     *
     * @param $user
     * @param $post
     * @param $permission
     * @return bool
     */
	public function editOwnPost($user, $post, $permission) {
		// This is a helper method for getting the model if $post is id
		// $post = $this->getModel(\App\Post::class, $post);

		return $user->id === $post->user_id;
	}

    /**
     * @param $user
     * @param $post
     * @param $permission
     * @return bool
     * @throws \Exception
     */
    public function updatePostInCategory($user, $post, $permission) {
        // Данный метод возвращает модель в случае, если $post содержит id модели
        $post = $this->getModel(\App\Post::class, $post);

        return $user->category_id === $post->category_id;
    }

}
