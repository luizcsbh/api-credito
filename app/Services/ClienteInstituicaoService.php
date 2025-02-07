<?php

namespace App\Services;

use App\Repositories\ClienteInstituicaoRepositoryInterface;
use Exception;

/**
 * Serviço para gerenciamento da relação Cliente-Instituição.
 */
class ClienteInstituicaoService
{
    /**
     * @var ClienteInstituicaoRepositoryInterface Repositório da entidade ClienteInstituicao
     */
    protected ClienteInstituicaoRepositoryInterface $clienteInstituicaoRepository;

    /**
     * Construtor da classe ClienteInstituicaoService.
     *
     * @param ClienteInstituicaoRepositoryInterface $clienteInstituicaoRepository
     */
    public function __construct(ClienteInstituicaoRepositoryInterface $clienteInstituicaoRepository)
    {
        $this->clienteInstituicaoRepository = $clienteInstituicaoRepository;
    }

    /**
     * Retorna todas as relações Cliente-Instituição cadastradas.
     *
     * @return mixed Lista de relações Cliente-Instituição.
     */
    public function getAllClienteInstituicao()
    {
        return $this->clienteInstituicaoRepository->all();
    }

    /**
     * Retorna uma relação Cliente-Instituição pelo ID.
     *
     * @param int $id Identificador da relação Cliente-Instituição.
     * @return mixed Dados da relação Cliente-Instituição.
     * @throws Exception Se o ID não for encontrado.
     */
    public function getClienteInstituicaoById(int $id)
    {
        $clienteInstituicao = $this->clienteInstituicaoRepository->findById($id);
        if (!$clienteInstituicao) {
            throw new Exception("Identificador da tabela ClienteInstituicao não encontrado!");
        }

        return $clienteInstituicao;
    }

    /**
     * Cria uma nova relação Cliente-Instituição.
     *
     * @param array $data Dados da nova relação Cliente-Instituição.
     * @return mixed Dados da relação criada.
     */
    public function createClienteInstituicao(array $data)
    {
        return $this->clienteInstituicaoRepository->create($data);
    }

    /**
     * Atualiza uma relação Cliente-Instituição existente.
     *
     * @param int $id Identificador da relação Cliente-Instituição a ser atualizada.
     * @param array $data Dados para atualização.
     * @return mixed Dados da relação atualizada.
     * @throws Exception Se o ID não for encontrado.
     */
    public function updateClienteInstituicao(int $id, array $data)
    {
        $clienteInstituicao = $this->clienteInstituicaoRepository->findById($id);
        if (!$clienteInstituicao) {
            throw new Exception("Identificador da tabela ClienteInstituicao não encontrado!");
        }

        return $this->clienteInstituicaoRepository->update($id, $data);
    }

    /**
     * Exclui uma relação Cliente-Instituição pelo ID.
     *
     * @param int $id Identificador da relação Cliente-Instituição a ser excluída.
     * @return bool True se a exclusão for bem-sucedida, False caso contrário.
     */
    public function deleteClienteInstituicao(int $id): bool
    {
        return $this->clienteInstituicaoRepository->delete($id);
    }
}
