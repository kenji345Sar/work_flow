<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TrelloController extends Controller
{
    //
    public function showTrelloTasks()
    {
        try {

            $apiKey = env('TRELLO_API_KEY', 'default_value');
            $token = env('TRELLO_TOKEN', 'default_value');
            $boardId = env('TRELLO_BOARD_ID', 'default_value');
            $client = new Client(['base_uri' => 'https://api.trello.com']);
            $response = $client->request('GET', "/1/boards/{$boardId}/lists", [
                'query' => [
                    'cards' => 'open',
                    'key' => $apiKey,
                    'token' => $token
                ]
            ]);
            Log::info($response->getBody()->getContents());
            $lists = json_decode($response->getBody(), true);
            // データをVue側で処理しやすいように整形して返す
            return response()->json($lists);
        } catch (\Exception $e) {
            Log::error('Error in showTrelloTasks:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Failed to fetch Trello tasks.'], 500);
        }
    }
}
