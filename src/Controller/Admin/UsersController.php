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
        $user = $this->Auth->user();

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
                // Update user's data for Auth after edit
                if ($this->Auth->user('id') === $user->id) {
                    $data = $user->toArray();
                    $this->Auth->setUser($data);
                }

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

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->danger(__('Não foi possível salvar as alterações. Por favor, tente novamente.<br>'), [
                'params' => ['errors' => $user->getErrors()],
                'escape' => false
            ]);
        }

        $this->set(compact('user'));
    }

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
