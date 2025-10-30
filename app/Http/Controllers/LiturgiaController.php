<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LiturgiaController extends Controller
{
    public function index()
    {
        try {
            $data = $this->getLiturgiaData();
            
            if (isset($data['error'])) {
                return view('liturgia', ['error' => $data['error']]);
            }

            return view('liturgia', compact('data'));
        } catch (\Exception $e) {
            Log::error('Erro geral na liturgia: '.$e->getMessage());
            return view('liturgia', ['error' => 'Erro de conexão com a API.']);
        }
    }

    public function parishPage()
    {
        try {
            $data = $this->getLiturgiaData();
            
            if (isset($data['error'])) {
                return view('site.paroquia.cristo-redentor')->with('liturgiaError', $data['error']);
            }

            return view('site.paroquia.cristo-redentor', ['liturgiaData' => $data]);
        } catch (\Exception $e) {
            Log::error('Erro ao carregar página da paróquia: '.$e->getMessage());
            return view('site.paroquia.cristo-redentor')->with('liturgiaError', 'Erro ao carregar a liturgia do dia.');
        }
    }

    private function getLiturgiaData()
    {
        try {
            $response = Http::timeout(10)->get('https://liturgia.up.railway.app/v2/');

            if ($response->failed()) {
                Log::error('Erro na API da liturgia', ['status' => $response->status()]);
                return ['error' => 'Não foi possível carregar a liturgia do dia.'];
            }

            $data = $response->json();

            if (empty($data)) {
                Log::warning('API retornou vazio.');
                return ['error' => 'Sem dados disponíveis no momento.'];
            }

            return $data;
        } catch (\Exception $e) {
            Log::error('Erro ao buscar dados da liturgia: '.$e->getMessage());
            return ['error' => 'Erro de conexão com a API.'];
        }
    }
}
