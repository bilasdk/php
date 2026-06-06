<?php

declare(strict_types=1);

namespace Bila\Accounts;

use Bila\Accounts\AccountResponseDto\Status;
use Bila\Accounts\AccountResponseDto\Type;
use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AccountDetailsDtoShape from \Bila\Accounts\AccountDetailsDto
 *
 * @phpstan-type AccountResponseDtoShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   currency: string,
 *   details: AccountDetailsDto|AccountDetailsDtoShape,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   availableBalance?: string|null,
 *   ledgerBalance?: string|null,
 * }
 */
final class AccountResponseDto implements BaseModel
{
    /** @use SdkModel<AccountResponseDtoShape> */
    use SdkModel;

    /**
     * Account UUID.
     */
    #[Required]
    public string $id;

    /**
     * Account creation timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Currency code.
     */
    #[Required]
    public string $currency;

    /**
     * Account details.
     */
    #[Required]
    public AccountDetailsDto $details;

    /**
     * Account status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Account type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Available balance.
     */
    #[Optional]
    public ?string $availableBalance;

    /**
     * Ledger balance.
     */
    #[Optional]
    public ?string $ledgerBalance;

    /**
     * `new AccountResponseDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountResponseDto::with(
     *   id: ..., createdAt: ..., currency: ..., details: ..., status: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountResponseDto)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withDetails(...)
     *   ->withStatus(...)
     *   ->withType(...)
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
     *
     * @param AccountDetailsDto|AccountDetailsDtoShape $details
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        string $currency,
        AccountDetailsDto|array $details,
        Status|string $status,
        Type|string $type,
        ?string $availableBalance = null,
        ?string $ledgerBalance = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['details'] = $details;
        $self['status'] = $status;
        $self['type'] = $type;

        null !== $availableBalance && $self['availableBalance'] = $availableBalance;
        null !== $ledgerBalance && $self['ledgerBalance'] = $ledgerBalance;

        return $self;
    }

    /**
     * Account UUID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Account creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * Account details.
     *
     * @param AccountDetailsDto|AccountDetailsDtoShape $details
     */
    public function withDetails(AccountDetailsDto|array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }

    /**
     * Account status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Account type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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
     * Ledger balance.
     */
    public function withLedgerBalance(string $ledgerBalance): self
    {
        $self = clone $this;
        $self['ledgerBalance'] = $ledgerBalance;

        return $self;
    }
}
