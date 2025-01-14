<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\CreateClientRequest;
use App\Models\Client;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(
        private readonly Logger $logger
    ) {}

    public function index(): View
    {
        return view('clients.index', [
            'clients' => Client::all(),
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
                ->with('status', 'error');
        }
    }
}
