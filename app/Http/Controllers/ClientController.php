<?php

namespace App\Http\Controllers;

use App\Http\Enums\LoanTypeEnum;
use App\Http\Requests\Client\CashLoanRequest;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\HomeLoanRequest;
use App\Models\Client;
use App\Models\Loans\CashLoan;
use App\Models\Loans\HomeLoan;
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

            return Redirect::route('clients.index')->with(
                'success',
                $this->successMessage('created Client')
            );
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.create')->with('error', self::DEFAULT_ERROR_MESSAGE);
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

            return Redirect::route('clients.index')->with(
                'success',
                $this->successMessage('updated Client')
            );
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.edit', $client)->with('error', self::DEFAULT_ERROR_MESSAGE);
        }
    }

    public function destroy(Client $client): RedirectResponse
    {
        try {
            $client->delete();

            return Redirect::route('clients.index')->with(
                'success',
                $this->successMessage('deleted Client')
            );
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.edit', $client)
                ->with('error', self::DEFAULT_ERROR_MESSAGE);
        }
    }

    public function applyForCashLoan(Client $client, CashLoanRequest $request): RedirectResponse
    {
        try {
            $adviser = $request->user();

            $loan = $client->cashLoan;

            if ($adviser->cannot('update', $loan)) {
                return Redirect::route('clients.edit', $client)
                    ->with('error', 'You are unauthorized to update this product!');
            }

            $cashProduct = $loan?->cashProduct;

            if ($cashProduct) {
                $cashProduct->update($request->validated());
            } else {
                DB::transaction(static function () use ($client, $adviser, $request) {
                    CashLoan::create(
                        $request->validated() +
                        [
                            'loan_id' => Loan::create([
                                'type' => LoanTypeEnum::CASH->value,
                                'adviser_id' => $adviser->id,
                                'client_id' => $client->id,
                            ])->id
                        ]
                    );
                });
            }

            return Redirect::back()->with('success', $this->successMessage('applied For Cash Loan'));
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

            if ($loan !== null && $adviser->cannot('update', $loan)) {
                return Redirect::route('clients.edit', $client)
                    ->with('error', 'You are unauthorized to update this product!');
            }

            $homeProduct = $loan?->homeProduct;

            if ($homeProduct) {
                $homeProduct->update($request->validated());
            } else {
                DB::transaction(static function () use ($client, $adviser, $request) {
                    HomeLoan::create(
                        $request->validated() +
                        [
                            'loan_id' => Loan::create([
                                'type' => LoanTypeEnum::HOME->value,
                                'adviser_id' => $adviser->id,
                                'client_id' => $client->id,
                            ])->id
                        ]
                    );
                });
            }

            return Redirect::back()->with('success', $this->successMessage('applied For Home Loan'));
        } catch (Exception $exception) {
            $this->logger->error($exception);

            return Redirect::route('clients.edit', $client)
                ->with('error', self::DEFAULT_ERROR_MESSAGE);
        }
    }
}
