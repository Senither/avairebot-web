<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class CommandsController extends ApiController
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

            return $this->sendSuccess($commands);
        } catch (\Exception $e) {
            return $this->sendMissingFile();
        }
    }

    protected function sendMissingFile()
    {
        return $this->sendErrorResponse('The command map JSON file were not found.', 404);
    }

    protected function sendInvalidFormat()
    {
        return $this->sendErrorResponse('The command map JSON file is not formatted correctly.', 500);
    }
}
