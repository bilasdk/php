<?php

declare(strict_types=1);

namespace Bila\Accounts;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type AccountDetailsDtoShape = array{
 *   accountName: string, type: string, tillNumber?: string|null
 * }
 */
final class AccountDetailsDto implements BaseModel
{
    /** @use SdkModel<AccountDetailsDtoShape> */
    use SdkModel;

    /**
     * Account holder name.
     */
    #[Required]
    public string $accountName;

    /**
     * Account detail type.
     */
    #[Required]
    public string $type;

    /**
     * Till number (for mobile money).
     */
    #[Optional]
    public ?string $tillNumber;

    /**
     * `new AccountDetailsDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountDetailsDto::with(accountName: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountDetailsDto)->withAccountName(...)->withType(...)
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
        string $accountName,
        string $type,
        ?string $tillNumber = null
    ): self {
        $self = new self;

        $self['accountName'] = $accountName;
        $self['type'] = $type;

        null !== $tillNumber && $self['tillNumber'] = $tillNumber;

        return $self;
    }

    /**
     * Account holder name.
     */
    public function withAccountName(string $accountName): self
    {
        $self = clone $this;
        $self['accountName'] = $accountName;

        return $self;
    }

    /**
     * Account detail type.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Till number (for mobile money).
     */
    public function withTillNumber(string $tillNumber): self
    {
        $self = clone $this;
        $self['tillNumber'] = $tillNumber;

        return $self;
    }
}
