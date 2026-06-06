<?php

declare(strict_types=1);

namespace Bila\Transactions;

use Bila\Core\Attributes\Optional;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\Transactions\TransactionListParams\Type;

/**
 * Retrieve a paginated list of transactions.
 *
 * @see Bila\Services\TransactionsService::list()
 *
 * @phpstan-type TransactionListParamsShape = array{
 *   accountID?: string|null,
 *   endDate?: string|null,
 *   page?: float|null,
 *   perPage?: float|null,
 *   startDate?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class TransactionListParams implements BaseModel
{
    /** @use SdkModel<TransactionListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by account ID.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Filter by end date (ISO 8601).
     */
    #[Optional]
    public ?string $endDate;

    /**
     * Page number (default: 1).
     */
    #[Optional]
    public ?float $page;

    /**
     * Items per page (default: 50).
     */
    #[Optional]
    public ?float $perPage;

    /**
     * Filter by start date (ISO 8601).
     */
    #[Optional]
    public ?string $startDate;

    /**
     * Filter by transaction type.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $accountID = null,
        ?string $endDate = null,
        ?float $page = null,
        ?float $perPage = null,
        ?string $startDate = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $page && $self['page'] = $page;
        null !== $perPage && $self['perPage'] = $perPage;
        null !== $startDate && $self['startDate'] = $startDate;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Filter by account ID.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Filter by end date (ISO 8601).
     */
    public function withEndDate(string $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Page number (default: 1).
     */
    public function withPage(float $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Items per page (default: 50).
     */
    public function withPerPage(float $perPage): self
    {
        $self = clone $this;
        $self['perPage'] = $perPage;

        return $self;
    }

    /**
     * Filter by start date (ISO 8601).
     */
    public function withStartDate(string $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Filter by transaction type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
