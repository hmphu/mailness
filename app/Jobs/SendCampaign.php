<?php

namespace App\Jobs;

use App\Campaign;
use App\Lists;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;

    protected $list;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Campaign $campaign, Lists $list)
    {
        $this->campaign = $campaign;
        $this->list = $list;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // @todo don't insert bounced contacts
        DB::insert('insert into sending_logs (campaign_id , contact_id ) SELECT ? , id FROM contacts where list_id = ?', [$this->campaign->id, $this->list->id]);
        foreach ($this->list->contacts as $contact) {
            SendEmail::dispatch($contact, $this->campaign);
        }
    }
}
