<?php

namespace App\Services;

use App\Repositories\ClienteRepositoryInterface;
use Exception;

/**
 * Serviço para manipulação de Clientes
 */
class ClienteService
{
    /**
     * @var ClienteRepositoryInterface Repositório do Cliente
     */
    protected $clienteRepository;

    /**
     * Construtor do serviço de Cliente
     *
     * @param ClienteRepositoryInterface $clienteRepository
     */
    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Retorna todos os clientes
     *
     * @return mixed Lista de clientes
     */
    public function getAllCliente()
    {
        return $this->clienteRepository->all();
    }

    /**
     * Retorna um cliente pelo ID
     *
     * @param int $id ID do cliente
     * @return mixed Dados do cliente
     * @throws Exception Se o cliente não for encontrado
     */
    public function getClienteById($id)
    {
        $cliente = $this->clienteRepository->findById($id);
        if (!$cliente) {
            throw new Exception("Cliente não encontrado!");
        }

        return $cliente->with(['instituicoes', 'modalidades'])->findOrFail($id);
    }

    /**
     * Cria um novo cliente
     *
     * @param array $data Dados do novo cliente
     * @return mixed Cliente criado
     */
    public function createCliente(array $data)
    {
        return $this->clienteRepository->create($data);
    }

    /**
     * Atualiza os dados de um cliente existente
     *
     * @param int $id ID do cliente a ser atualizado
     * @param array $data Novos dados do cliente
     * @return mixed Cliente atualizado
     * @throws Exception Se o cliente não for encontrado
     */
    public function updateCliente($id, array $data)
    {
        $cliente = $this->clienteRepository->findById($id);
        if (!$cliente) {
            throw new Exception("Cliente não encontrado!");
        }

        return $this->clienteRepository->update($id, $data);
    }

    /**
     * Exclui um cliente pelo ID
     *
     * @param int $id ID do cliente a ser excluído
     * @return bool Retorna true se a exclusão for bem-sucedida
     * @throws Exception Se o cliente não for encontrado
     */
    public function deleteCliente($id)
    {
        $cliente = $this->clienteRepository->findById($id);
        if (!$cliente) {
            throw new Exception("Cliente não encontrado!");
        }

        return $this->clienteRepository->delete($id);
    }
    /**
     * Exclui um cliente junto com suas associações.
     *
     * @param int $id ID do cliente a ser excluído
     * @throws \Exception Caso o cliente não seja encontrado
     * @return void
     */
    public function deleteClienteWithAssociations($id)
    {
        $cliente = $this->getClienteById($id);

        $this->detachClienteAssociations($cliente);

        $this->deleteCliente($id);
    }

    /**
     * Remove todas as associações do cliente com outras entidades.
     *
     * @param \App\Models\Cliente $cliente Objeto do cliente
     * @return void
     */
    private function detachClienteAssociations($cliente)
    {
        if ($cliente->instituicoes()->exists()) {
            $cliente->instituicoes()->detach();
        }

        if ($cliente->modalidades()->exists()) {
            $cliente->modalidades()->detach();
        }
    }

}
