@serviceTitle("API de Instituições")
@serviceVersion("1.0.0")
@server("http://localhost:8000/api", "Servidor Local")
namespace InstituicoesApi;

using TypeSpec.Http;
using TypeSpec.Rest;

@tag("Instituições")
namespace Instituicoes;

model Instituicao {
  id: int64;
  codigo: int64;
  nome: string;
  created_at: string;
  updated_at: string;

  // Adicione outros campos conforme seu modelo
}

model ErrorResponse {
  id: int64;
  nome: string;
  created_at: string;
  updated_at: string;
}

model ErrorResponse {
  success: boolean;
  message: string;
  error?: string;
}

@route("/instituicoes")
interface Instituicoes {
  // Listar todas as instituições
  @get
  @summary("Lista todas as instituições")
  @doc("Retorna uma lista paginada de instituições")
  op listar(): {
    @statusCode statusCode: 200;
    @body body: {
      success: boolean;
      data: InstituicaoResponse[];
    } | ErrorResponse;
  };

  // Exibir uma instituição específica
  @get
  @summary("Exibe uma instituição específica")
  @route("{id}")
  op exibir(
    @path id: int64
  ): {
    @statusCode statusCode: 200;
    @body body: {
      success: boolean;
      data: InstituicaoResponse;
    } | ErrorResponse;
  };

  // Criar nova instituição
  @post
  @summary("Cria uma nova instituição")
  op criar(
    @body body: InstituicaoRequest
  ): {
    @statusCode statusCode: 201;
    @body body: {
      success: boolean;
      message: string;
      data: InstituicaoResponse;
    } | ErrorResponse;
  };

  // Atualizar instituição
  @put
  @summary("Atualiza uma instituição existente")
  @route("{id}")
  op atualizar(
    @path id: int64,
    @body body: InstituicaoRequest
  ): {
    @statusCode statusCode: 200;
    @body body: {
      success: boolean;
      message: string;
      data: InstituicaoResponse;
    } | ErrorResponse;
  };

  // Excluir instituição
  @delete
  @summary("Exclui uma instituição")
  @route("{id}")
  op excluir(
    @path id: int64
  ): {
    @statusCode statusCode: 200;
    @body body: {
      success: boolean;
      message: string;
    } | ErrorResponse;
  };
}