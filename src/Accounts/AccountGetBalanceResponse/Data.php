<?php

declare(strict_types=1);

namespace Bila\Accounts\AccountGetBalanceResponse;

use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   availableBalance: string, currency: string, ledgerBalance: string
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Available balance.
     */
    #[Required]
    public string $availableBalance;

    /**
     * Currency code.
     */
    #[Required]
    public string $currency;

    /**
     * Ledger balance.
     */
    #[Required]
    public string $ledgerBalance;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(availableBalance: ..., currency: ..., ledgerBalance: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withAvailableBalance(...)->withCurrency(...)->withLedgerBalance(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $availableBalance,
        string $currency,
        string $ledgerBalance
    ): self {
        $self = new self;

        $self['availableBalance'] = $availableBalance;
        $self['currency'] = $currency;
        $self['ledgerBalance'] = $ledgerBalance;

        return $self;
    }

    /**
     * Available balance.
     */
    public function withAvailableBalance(string $availableBalance): self
    {
        $self = clone $this;
        $self['availableBalance'] = $availableBalance;

        return $self;
    }

    /**
     * Currency code.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Ledger balance.
     */
    public function withLedgerBalance(string $ledgerBalance): self
    {
        $self = clone $this;
        $self['ledgerBalance'] = $ledgerBalance;

        return $self;
    }
}
