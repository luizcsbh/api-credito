<?php

namespace App\Services;

use App\Repositories\ClienteModalidadeRepositoryInterface;
use Exception;

/**
 * Serviço para gerenciamento da relação Cliente-Modalidade.
 */
class ClienteModalidadeService
{
    /**
     * @var ClienteModalidadeRepositoryInterface Repositório da entidade ClienteModalidade
     */
    protected ClienteModalidadeRepositoryInterface $clienteModalidadeRepository;

    /**
     * Construtor da classe ClienteModalidadeService.
     *
     * @param ClienteModalidadeRepositoryInterface $clienteModalidadeRepository
     */
    public function __construct(ClienteModalidadeRepositoryInterface $clienteModalidadeRepository)
    {
        $this->clienteModalidadeRepository = $clienteModalidadeRepository;
    }

    /**
     * Retorna todas as relações Cliente-Modalidade cadastradas.
     *
     * @return mixed Lista de relações Cliente-Modalidade.
     */
    public function getAllClienteModalidade()
    {
        return $this->clienteModalidadeRepository->all();
    }

    /**
     * Retorna uma relação Cliente-Modalidadepelo ID.
     *
     * @param int $id Identificador da relação Cliente-Modalidade.
     * @return mixed Dados da relação Cliente-Modalidade.
     * @throws Exception Se o ID não for encontrado.
     */
    public function getClienteModalidadeById(int $id)
    {
        $clienteModalidade = $this->clienteModalidadeRepository->findById($id);
        if (!$clienteModalidade) {
            throw new Exception("Identificador da tabela ClienteModalidade não encontrado!");
        }

        return $clienteModalidade;
    }

    /**
     * Cria uma nova relação Cliente-Modalidade.
     *
     * @param array $data Dados da nova relação Cliente-Modalidade.
     * @return mixed Dados da relação criada.
     */
    public function createClienteModalidade(array $data)
    {
        return $this->clienteModalidadeRepository->create($data);
    }

    /**
     * Atualiza uma relação Cliente-Modalidadeexistente.
     *
     * @param int $id Identificador da relação Cliente-Modalidadea ser atualizada.
     * @param array $data Dados para atualização. 
     * @return mixed Dados da relação atualizada.
     * @throws Exception Se o ID não for encontrado.
     */
    public function updateClienteModalidade(int $id, array $data)
    {
        $clienteModalidade = $this->clienteModalidadeRepository->findById($id);
        if (!$clienteModalidade) {
            throw new Exception("Identificador da tabela ClienteModalidade não encontrado!");
        }

        return $this->clienteModalidadeRepository->update($id, $data);
    }

    /**
     * Exclui uma relação Cliente-Modalidadepelo ID.
     *
     * @param int $id Identificador da relação Cliente-Modalidadea ser excluída.
     * @return bool True se a exclusão for bem-sucedida, False caso contrário.
     */
    public function deleteClienteModalidade(int $id): bool
    {
        return $this->clienteModalidadeRepository->delete($id);
    }
}
