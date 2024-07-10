<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateSystem extends Command
{
    //protected $signature = 'system:update';
   // protected $description = 'Perform system updates';

   public function __construct()
   {
       parent::__construct();
   }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-system';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //update logic
        $admin = User::role('SuperAdmin')->first();
        $admin->notify(new SystemUpdateNotification());

        $this->info('system updated successfully');
    }
}
