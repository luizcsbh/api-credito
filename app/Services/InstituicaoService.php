<?php

namespace App\Services;

use App\Repositories\InstituicaoRepositoryInterface;
use Exception;

/**
 * Serviço para manipulação de Instituições
 */
class InstituicaoService
{
    /**
     * @var InstituicaoRepositoryInterface Repositório da Instituição
     */
    protected $instituicaoRepository;

    /**
     * Construtor do serviço da Instituição
     *
     * @param InstituicaoRepositoryInterface $instituicaoRepository
     */
    public function __construct(InstituicaoRepositoryInterface $instituicaoRepository)
    {
        $this->instituicaoRepository = $instituicaoRepository;
    }

    /**
     * Retorna todas as instituições
     *
     * @return mixed Lista de instituições
     */
    public function getAllInstituicao()
    {
        return $this->instituicaoRepository->all();
    }

    /**
     * Retorna uma instituição pelo ID
     *
     * @param int $id ID da instituição
     * @return mixed Dados da instituição
     * @throws Exception Se a instituição não for encontrada
     */
    public function getInstituicaoById(int $id)
    {
        $instituicao = $this->instituicaoRepository->findById($id);
        if (!$instituicao) {
            throw new Exception("Instituição não encontrada!");
        }

        return $instituicao;
    }

    /**
     * Cria uma nova instituição
     *
     * @param array $data Dados da nova instituição
     * @return mixed Instituição criada
     */
    public function createInstituicao(array $data)
    {
        return $this->instituicaoRepository->create($data);
    }

    /**
     * Atualiza os dados de uma instituição existente
     *
     * @param int $id ID da instituição a ser atualizada
     * @param array $data Novos dados da instituição
     * @return mixed Instituição atualizada
     * @throws Exception Se a instituição não for encontrada
     */
    public function updateInstituicao(int $id, array $data)
    {
        $instituicao = $this->instituicaoRepository->findById($id);
        if (!$instituicao) {
            throw new Exception("Instituição não encontrada!");
        }

        return $this->instituicaoRepository->update($id, $data);
    }

    /**
     * Exclui uma instituição pelo ID
     *
     * @param int $id ID da instituição a ser excluída
     * @return bool Retorna true se a exclusão for bem-sucedida
     * @throws Exception Se a instituição não for encontrada
     */
    public function deleteInstituicao(int $id)
    {
        return $this->instituicaoRepository->delete($id);
    }

    /**
     * Exclui uma instituição caso não tenha associações com clientes ou modalidades.
     *
     * @param int $id ID da instituição a ser excluída
     * @throws \Exception Caso a instituição tenha associações ou não seja encontrada
     * @return void
     */
    public function deleteInstituicaoWithValidation(int $id)
    {
        $instituicao = $this->getInstituicaoById($id);

        // Verifica associações antes de excluir
        $associacoes = $this->getAssociations($instituicao);

        if (!empty($associacoes)) {
            throw new \Exception("Não é possível excluir a instituição pois está associada a: " . implode(', ', $associacoes));
        }

        // Exclui a instituição
        $this->deleteInstituicao($id);
    }

    /**
     * Retorna uma lista das associações da instituição.
     *
     * @param \App\Models\Instituicao $instituicao Objeto da instituição
     * @return array Lista de associações encontradas
     */
    private function getAssociations($instituicao)
    {
        $associacoes = [];

        if ($instituicao->clientes()->exists()) {
            $associacoes[] = 'Clientes';
        }

        if ($instituicao->modalidades()->exists()) {
            $associacoes[] = 'Modalidades';
        }

        return $associacoes;
    }
}
