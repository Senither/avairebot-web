<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommandsController extends Controller
{
    protected $commandFile = 'commandMap.json';

    public function index()
    {
        if (! file_exists(storage_path($this->commandFile))) {
            return $this->sendMissingFile();
        }

        try {
            $commands = json_decode(
                file_get_contents(storage_path($this->commandFile))
            );

            if ($commands == null) {
                return $this->sendInvalidFormat();
            }

            return response([
                'status' => 200,
                'data' => $commands,
            ]);
        } catch (\Exception $e) {
            return $this->sendMissingFile();
        }
    }

    protected function sendMissingFile()
    {
        return response([
            'status' => 404,
            'reason' => 'The command map JSON file were not found.',
        ], 404);
    }

    protected function sendInvalidFormat()
    {
        return response([
            'status' => 500,
            'reason' => 'The command map JSON file is not formatted correctly.',
        ], 500);
    }
}
