<?php

namespace App\Console\Commands;

use App\Models\AccessToken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateNewAccessToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new access token for a specified zone';

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
     * @return mixed
     */
    public function handle()
    {
        $zones = [];

        while (true) {
            $zone = $this->ask('What is the zone name you wish to add?');

            // Todo: regex validation
            // \A([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}\Z

            if ($this->confirm("Do you want to add the following zone to this API: {$zone}. Is this correct", 'no'))
                array_push($zones, $zone);

            if (!$this->confirm('Do you wish to add another zone to this access token?', 'yes'))
                break;
        }

        $access_token = Str::random(40);
        $model = new AccessToken([
            'secret' => Hash::make($access_token),
            'zones' => $zone,
        ]);

        $this->info('A new API token has been made for the zones: ' . join(', ', $zones));
        $this->info('Access Token is: ' . $access_token);
    }
}
