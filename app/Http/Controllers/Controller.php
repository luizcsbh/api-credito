<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="API Simulação de Crédito",
 *     version="1.0.0",
 *     description="Documentação da API de Simulação de Crédito. Esta API fornece funcionalidades para gerenciar clientes, instituições, modalidades de crédito e ofertas.",
 *     @OA\Contact(
 *         email="luizcsdev@gmail.com",
 *         name="Luiz Santos Full Stack Developer "
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8000/api",
 *     description="Servidor Local"
 * )
 * 
 * @OA\Tag(
 *     name="Clientes",
 *     description="Gerenciamento de clientes"
 * )
 * 
 * @OA\Tag(
 *     name="Instituições",
 *     description="Gerenciamento de instituições financeiras"
 * )
 * 
 * @OA\Tag(
 *     name="Modalidades",
 *     description="Gerenciamento de modalidades de crédito"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
