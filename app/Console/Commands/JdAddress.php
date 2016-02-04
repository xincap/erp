<?php

namespace XinGroup\Console\Commands;

use Illuminate\Console\Command;
use Jd\JdClient;
use Jd\Request\AreasProvinceGetRequest;
use Event;

class JdAddress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jd:address';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $c = new JdClient();
        $c->setAppKey(env('JD_APP_ID'));
        $c->setAppSecret(env('JD_APP_SECRET'));
        $req    = new AreasProvinceGetRequest();
        $resp = $c->execute($req);
        $data   = $resp['baseAreaServiceResponse']['data'];
        foreach ($data as $key => $item) {
            Event::fire('jd.province', [$item]);
        }
        $this->info('success');
    }
}
