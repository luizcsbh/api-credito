<?php

namespace App\Services;

use App\Repositories\ModalidadeRepositoryInterface;
use Exception;

/**
 * Serviço para manipulação de Modalidades
 */
class ModalidadeService
{
    /**
     * @var ModalidadeRepositoryInterface Repositório da Modalidade
     */
    protected $modalidadeRepository;

    /**
     * Construtor do serviço de Modalidade
     *
     * @param ModalidadeRepositoryInterface $modalidadeRepository
     */
    public function __construct(ModalidadeRepositoryInterface $modalidadeRepository)
    {
        $this->modalidadeRepository = $modalidadeRepository;
    }

    /**
     * Retorna todas as modalidades
     *
     * @return mixed Lista de modalidades
     */
    public function getAllModalidade()
    {
        return $this->modalidadeRepository->all();
    }

    /**
     * Retorna uma modalidade pelo ID
     *
     * @param int $id ID da modalidade
     * @return mixed Dados da modalidade
     * @throws Exception Se a modalidade não for encontrada
     */
    public function getModalidadeById($id)
    {
        $modalidade = $this->modalidadeRepository->findById($id);
        if (!$modalidade) {
            throw new Exception("Modalidade não encontrada!");
        }

        return $modalidade;
    }

    /**
     * Cria uma nova modalidade
     *
     * @param array $data Dados da nova modalidade
     * @return mixed Modalidade criada
     */
    public function createModalidade(array $data)
    {
        return $this->modalidadeRepository->create($data);
    }

    /**
     * Atualiza os dados de uma modalidade existente
     *
     * @param int $id ID da modalidade a ser atualizada
     * @param array $data Novos dados da modalidade
     * @return mixed Modalidade atualizada
     * @throws Exception Se a modalidade não for encontrada
     */
    public function updateModalidade($id, array $data)
    {
        $modalidade = $this->modalidadeRepository->findById($id);
        if (!$modalidade) {
            throw new Exception("Modalidade não encontrada!");
        }

        return $this->modalidadeRepository->update($id, $data);
    }

    /**
     * Exclui uma modalidade pelo ID
     *
     * @param int $id ID da modalidade a ser excluída
     * @return bool Retorna true se a exclusão for bem-sucedida
     * @throws Exception Se a modalidade não for encontrada
     */
    public function deleteModalidade($id)
    {
        $modalidade = $this->modalidadeRepository->findById($id);
        if (!$modalidade) {
            throw new Exception("Modalidade não encontrada!");
        }

        return $this->modalidadeRepository->delete($id);
    }
}
