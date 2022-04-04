<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use GuzzleHttp\Client;

class createBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createBackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a backup and uploads it to onedrive.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tenantId = '9cb613b4-fccb-4157-9644-4944635cd3af';
        $clientId = '4ca20de8-6467-4206-ade2-cdc65b0efe93';
        $clientSecret = 'Bdh7Q~0eik0h.k5keQG4czeySnxbHhi_SrTpe';

        $guzzle = new Client();
        $url = "https://login.microsoftonline.com/$tenantId/oauth2/token";
        $user_token = json_decode($guzzle->post($url, [
            'form_params' => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'resource' => 'https://graph.microsoft.com/',
                'grant_type' => 'password',
                'username' => 'llopez@culturasv.onmicrosoft.com',
                'password' => 'McLeo234861'
            ],
        ])->getBody()->getContents());
        $user_accessToken = $user_token->access_token;

        $graph = new Graph();
        $graph->setAccessToken($user_accessToken);

        $graph->createRequest("PUT", "/me/drive/root/children/ejemplo.txt/content")
        ->upload(__DIR__.'/ejemplo.txt');

        $this->info('File uploaded to OneDrive successfully.');

        return 0;
    }
}
