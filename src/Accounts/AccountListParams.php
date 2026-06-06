<?php

declare(strict_types=1);

namespace Bila\Accounts;

use Bila\Core\Attributes\Optional;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;

/**
 * Retrieve a paginated list of accounts/wallets for the authenticated merchant.
 *
 * @see Bila\Services\AccountsService::list()
 *
 * @phpstan-type AccountListParamsShape = array{
 *   page?: float|null, perPage?: float|null
 * }
 */
final class AccountListParams implements BaseModel
{
    /** @use SdkModel<AccountListParamsShape> */
    use SdkModel;
    use SdkParams;

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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $page = null, ?float $perPage = null): self
    {
        $self = new self;

        null !== $page && $self['page'] = $page;
        null !== $perPage && $self['perPage'] = $perPage;

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
}
