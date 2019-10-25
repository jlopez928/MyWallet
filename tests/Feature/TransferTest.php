<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Wallet;
use App\Transfer;

class TransferTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostTransfer()
    {
        $wallet = factory(Wallet::class)->create(); //con create en BD
        $transfer = factory(Transfer::class)->make(); //con make en Memoria
        
        $response = $this->json('POST', 'api/transfer', [
            'description'   => $transfer->description,
            'amount'        => $transfer->amount,
            'wallet_id'     => $wallet->id
        ]);

        $response->assertJsonStructure([
            'id',
            'description',
            'amount',
            'wallet_id'
        ])->assertStatus(201);

        $this->assertDatabaseHas('transfers', [
            'description'   => $transfer->description,
            'amount'        => $transfer->amount,
            'wallet_id'     => $wallet->id
        ]);

        $this->assertDatabaseHas('wallets', [
            'id'    => $wallet->id,
            'money' => $wallet->money + $transfer->amount,
        ]);

    }
}
