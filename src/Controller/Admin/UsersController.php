<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    const IMG_WIDTH = 150;
    const IMG_HIGHT = 150;

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 10
        ];

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    public function perfil()
    {
        // get user logged in
        $user = $this->Users->get($this->Auth->user('id'));

        $this->set(compact('user'));
    }

    public function editPerfil()
    {
        $userId = $this->Auth->user('id');

        $user = $this->Users->get($userId, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('As alterações foram salvas como sucesso.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'perfil']);
            }
            $this->Flash->danger(__('Não foi possível salvar as alterações. Por favor, tente novamente.<br>'), [
                'params' => ['errors' => $user->getErrors()],
                'escape' => false
            ]);
        }

        $this->set(compact('userId', 'user'));
    }

    public function alterPassword(int $userId)
    {
        $user = $this->Users->get($userId, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Senha do usuário alterada com sucesso.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->id]);
            }

            $this->Flash->danger(__('Não foi possível alterar a senha do usuário. Por favor, tente novamente.<br>'), [
                'params' => ['errors' => $user->getErrors()],
                'escape' => false
            ]);
        }

        $this->set(compact('user'));
    }

    public function alterPasswordProfile()
    {
        $userId = $this->Auth->user('id');

        $user = $this->Users->get($userId, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Senha alterada com sucesso.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'perfil']);
            }

            $this->Flash->danger(__('Não foi possível alterar a sua senha. Por favor, tente novamente.<br>'), [
                'params' => ['errors' => $user->getErrors()],
                'escape' => false
            ]);
        }

        $this->set(compact('user'));
    }

    public function alterImageProfile()
    {
        $userId = $this->Auth->user('id');

        $user = $this->Users->get($userId, [
            'contain' => []
        ]);

        $userImageNameOld = $user->imagem;


        if ($this->request->is(['patch', 'post' , 'put'])) {
            $user = $this->Users->newEntity();

            $user->imagem = $this->Users->slugUploadResizeImage($this->request->getData()['imagem']['name']);
            $user->id = $userId;

            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $pathDir = WWW_ROOT . "files" . DS . "users" . DS . $userId . DS;
                $imagemUpload = $this->request->getData()['imagem'];
                $imagemUpload['name'] = $user->imagem;

                if($this->Users->uploadResizeImage($imagemUpload, $pathDir, self::IMG_WIDTH, self::IMG_HIGHT)) {
                    //Delete old user's image
                    $this->Users->deleteFile($pathDir, $userImageNameOld, $user->imagem);

                    $this->Flash->success(__('Imagem alterada com sucesso'));

                    return $this->redirect(['controller' => 'Users', 'action' => 'perfil']);

                } else {
                    $user->imagem = $userImageNameOld;
                    $this->Users->save($user);

                    $this->Flash->danger(__('Não foi possível alterar a imagem. Erro ao realizar upload.<br>'), [
                        'params' => ['errors' => $user->getErrors()],
                        'escape' => false
                    ]);
                }

            } else {
                $this->Flash->danger(__('Não foi possível alterar a imagem. Por favor tente novamente.<br>'), [
                    'params' => ['errors' => $user->getErrors()],
                    'escape' => false
                ]);
            }
        }

        $this->set(compact('user'));
    }

    /* UPLOAD WITHOUT RESIZING IMAGE
    public function alterImageProfile()
    {
        $userId = $this->Auth->user('id');

        $user = $this->Users->get($userId, [
            'contain' => []
        ]);

        $userImageNameOld = $user->imagem;


        if ($this->request->is(['patch', 'post' , 'put'])) {
            $user = $this->Users->newEntity();

            $user->imagem = $this->Users->slugSingleUpload($this->request->getData()['imagem']['name']);
            $user->id = $userId;

            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $destino = WWW_ROOT . "files" . DS . "users" . DS . $userId . DS;
                $imagemUpload = $this->request->getData()['imagem'];
                $imagemUpload['name'] = $user->imagem;

                if($this->Users->singleUpload($imagemUpload, $destino)) {
                    //Delete old user's image
                    if ($userImageNameOld !== null && $userImageNameOld !== $user->imagem) {
                        unlink($destino . $userImageNameOld);
                    }

                    $this->Flash->success(__('Imagem alterada com sucesso'));

                    return $this->redirect(['controller' => 'Users', 'action' => 'perfil']);

                } else {
                    $user->imagem = $userImageNameOld;
                    $this->Users->save($user);

                    $this->Flash->danger(__('Não foi possível alterar a imagem. Erro ao realizar upload.<br>'), [
                        'params' => ['errors' => $user->getErrors()],
                        'escape' => false
                    ]);
                }

            } else {
                $this->Flash->danger(__('Não foi possível alterar a imagem. Por favor tente novamente.<br>'), [
                    'params' => ['errors' => $user->getErrors()],
                    'escape' => false
                ]);
            }
        }

        $this->set(compact('user'));
    }
    */

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário cadastrado com sucesso.'));
                return $this->redirect(['controler' => 'Users', 'action' => 'index']);
            }
            $this->Flash->danger(__('Não foi possível cadastrar o usuário. Por favor, tente novamente.<br>'), [
                'params' => ['errors' => $user->getErrors()],
                'escape' => false
            ]);
        }

        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('As alterações foram salvas como sucesso.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->id]);
            }
            $this->Flash->danger(__('Não foi possível salvar as alterações. Por favor, tente novamente.<br>'), [
                'params' => ['errors' => $user->getErrors()],
                'escape' => false
            ]);
        }

        $this->set(compact('user'));
    }

    public function alterImageUser($userId = null)
    {
        $user = $this->Users->get($userId, [
            'contain' => []
        ]);

        $userImageNameOld = $user->imagem;


        if ($this->request->is(['patch', 'post' , 'put'])) {
            $user = $this->Users->newEntity();

            $user->imagem = $this->Users->slugUploadResizeImage($this->request->getData()['imagem']['name']);
            $user->id = $userId;

            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $pathDir = WWW_ROOT . "files" . DS . "users" . DS . $userId . DS;
                $imagemUpload = $this->request->getData()['imagem'];
                $imagemUpload['name'] = $user->imagem;

                if($this->Users->uploadResizeImage($imagemUpload, $pathDir, self::IMG_WIDTH, self::IMG_HIGHT)) {
                    //Delete old user's image
                    $this->Users->deleteFile($pathDir, $userImageNameOld, $user->imagem);

                    $this->Flash->success(__('Imagem alterada com sucesso'));

                    return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->id]);

                } else {
                    $user->imagem = $userImageNameOld;
                    $this->Users->save($user);

                    $this->Flash->danger(__('Não foi possível alterar a imagem. Erro ao realizar upload.<br>'), [
                        'params' => ['errors' => $user->getErrors()],
                        'escape' => false
                    ]);
                }

            } else {
                $this->Flash->danger(__('Não foi possível alterar a imagem. Por favor tente novamente.<br>'), [
                    'params' => ['errors' => $user->getErrors()],
                    'escape' => false
                ]);
            }
        }

        $this->set(compact('user'));
    }

    /* UPLOAD WITHOUT RESIZE IMAGE
    public function alterImageUser($userId = null)
    {
        $user = $this->Users->get($userId, [
            'contain' => []
        ]);

        $userImageNameOld = $user->imagem;


        if ($this->request->is(['patch', 'post' , 'put'])) {
            $user = $this->Users->newEntity();

            $user->imagem = $this->Users->slugSingleUpload($this->request->getData()['imagem']['name']);
            $user->id = $userId;

            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $destino = WWW_ROOT . "files" . DS . "users" . DS . $userId . DS;
                $imagemUpload = $this->request->getData()['imagem'];
                $imagemUpload['name'] = $user->imagem;

                if($this->Users->singleUpload($imagemUpload, $destino)) {
                    //Delete old user's image
                    if ($userImageNameOld !== null && $userImageNameOld !== $user->imagem) {
                        unlink($destino . $userImageNameOld);
                    }

                    $this->Flash->success(__('Imagem alterada com sucesso'));

                    return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->id]);

                } else {
                    $user->imagem = $userImageNameOld;
                    $this->Users->save($user);

                    $this->Flash->danger(__('Não foi possível alterar a imagem. Erro ao realizar upload.<br>'), [
                        'params' => ['errors' => $user->getErrors()],
                        'escape' => false
                    ]);
                }

            } else {
                $this->Flash->danger(__('Não foi possível alterar a imagem. Por favor tente novamente.<br>'), [
                    'params' => ['errors' => $user->getErrors()],
                    'escape' => false
                ]);
            }
        }

        $this->set(compact('user'));
    }
    */

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $pathDir = WWW_ROOT . "files" . DS . "users" . DS . $user->id . DS;

        // Delete user directory
        $this->Users->deleteDirectory($pathDir);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Usuário excluido com sucesso.'));
        } else {
            $this->Flash->danger(__('Não foi possível excluir o usuário. Por favor, tente novamente.<br>'), [
                'params' => ['errors' => $user->getErrors()],
                'escape' => false
            ]);
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);

                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->danger(__('Usuário ou senha inválidos.'));
            }
        }
    }

    public function logout()
    {
        $this->Flash->success(__('Deslogado com sucesso.'));
        return $this->redirect($this->Auth->logout());
    }
}
