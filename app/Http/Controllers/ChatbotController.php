<?php

namespace App\Http\Controllers;

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        try{
            $text = $request->input('message');

            $projectId = 'utility-gravity-464716-q6';
            $credentials = storage_path('app/dialogflow-key.json');

            putenv("GOOGLE_APPLICATION_CREDENTIALS=$credentials");

            if (!file_exists($credentials)) {
                return response()->json(['error' => 'Archivo de credenciales no encontrado.'], 500);
            }

            putenv("GOOGLE_APPLICATION_CREDENTIALS=$credentials");

            $sessionsClient = new SessionsClient();
            $session = $sessionsClient->sessionName($projectId, uniqid());

            $textInput = new TextInput();
            $queryInput = new QueryInput();

            $response = $sessionsClient->detectIntent($session, $queryInput);
            $queryResult = $response->getQueryResult();

            return response()->json([
                'message' => $queryResult->getFulfillmentText()
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(), // ← Aquí verás el error exacto
            ], 500);
        }
    }
}
