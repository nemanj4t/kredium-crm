<?php

namespace App\Http\Controllers;

use App\Http\Enums\LoanTypeEnum;
use App\Http\Requests\Client\CashLoanRequest;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\HomeLoanRequest;
use App\Models\Client;
use App\Models\Loans\Loan;
use App\ReadModels\ClientQueryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(
        private readonly Logger $logger,
        private readonly ClientQueryInterface $clientQuery,
    ) {}

    public function index(): View
    {
        return view('clients.index', [
            'clients' => $this->clientQuery->all(),
        ]);
    }

    public function create(): View
    {
        return view('clients.create');
    }

    public function store(CreateClientRequest $request): RedirectResponse
    {
        try {
            Client::create($request->validated());

            return Redirect::route('clients.index')->with('status', 'client-created');
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.create')
                ->with('error', 'Whoops, something went wrong!');
        }
    }
    public function edit(Client $client): View
    {
        return view('clients.edit', ['client' => $client]);
    }

    public function update(Client $client, CreateClientRequest $request): RedirectResponse
    {
        try {
            $client->update($request->validated());

            return Redirect::route('clients.index')->with('status', 'client-updated');
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.edit', $client)
                ->with('error', 'Whoops, something went wrong!');
        }
    }

    public function destroy(Client $client): RedirectResponse
    {
        try {
            $client->delete();

            return Redirect::route('clients.index')->with('status', 'client-deleted');
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.edit', $client)
                ->with('error', 'Whoops, something went wrong!');
        }
    }

    public function applyForCashLoan(Client $client, CashLoanRequest $request): RedirectResponse
    {
        try {
            $adviser = $request->user();
            $loan = $client->cashLoan;

            if ($loan->exists()) {
                $loan->cashLoan()->update($request->validated());
            } else {
                DB::transaction(static function () use ($client, $adviser, $request) {
                    $loan = Loan::create([
                        'type' => LoanTypeEnum::CASH->value,
                        'adviser_id' => $adviser->id,
                        'client_id' => $client->id,
                    ]);

                    $loan->cashLoan()->create($request->validated());
                });
            }

            return Redirect::back()->with('success', 'Applied Successfully!');
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.edit', $client)
                ->with('error', 'Whoops, something went wrong!');
        }
    }

    public function applyForHomeLoan(Client $client, HomeLoanRequest $request): RedirectResponse
    {
        try {
            $adviser = $request->user();
            $loan = $client->homeLoan;

            if ($loan) {
                $loan->homeLoan()->update($request->validated());
            } else {
                DB::transaction(static function () use ($client, $adviser, $request) {
                    $loan = Loan::create([
                        'type' => LoanTypeEnum::HOME->value,
                        'adviser_id' => $adviser->id,
                        'client_id' => $client->id,
                    ]);

                    $loan->homeLoan()->create($request->validated());
                });
            }

            return Redirect::back()->with('status', 'client-updated');
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.edit', $client)
                ->with('error', 'Whoops, something went wrong!');
        }
    }
}
