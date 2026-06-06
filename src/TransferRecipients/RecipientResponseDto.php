<?php

declare(strict_types=1);

namespace Bila\TransferRecipients;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;
use Bila\TransferRecipients\RecipientResponseDto\Type;

/**
 * @phpstan-type RecipientResponseDtoShape = array{
 *   id: string,
 *   accountName: string,
 *   country: string,
 *   createdAt: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 *   accountNumber?: string|null,
 *   bankID?: string|null,
 *   bankName?: string|null,
 *   operator?: string|null,
 *   phone?: string|null,
 * }
 */
final class RecipientResponseDto implements BaseModel
{
    /** @use SdkModel<RecipientResponseDtoShape> */
    use SdkModel;

    /**
     * Recipient UUID.
     */
    #[Required]
    public string $id;

    /**
     * Account holder name.
     */
    #[Required]
    public string $accountName;

    /**
     * Country code.
     */
    #[Required]
    public string $country;

    /**
     * Creation timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Transfer recipient type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Bank account number (bank-account only).
     */
    #[Optional]
    public ?string $accountNumber;

    /**
     * Bank ID (bank-account only).
     */
    #[Optional('bankId')]
    public ?string $bankID;

    /**
     * Bank name (bank-account only).
     */
    #[Optional]
    public ?string $bankName;

    /**
     * Mobile money operator (mobile-money only).
     */
    #[Optional]
    public ?string $operator;

    /**
     * Phone number (mobile-money only).
     */
    #[Optional]
    public ?string $phone;

    /**
     * `new RecipientResponseDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecipientResponseDto::with(
     *   id: ..., accountName: ..., country: ..., createdAt: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RecipientResponseDto)
     *   ->withID(...)
     *   ->withAccountName(...)
     *   ->withCountry(...)
     *   ->withCreatedAt(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountName,
        string $country,
        \DateTimeInterface $createdAt,
        Type|string $type,
        ?string $accountNumber = null,
        ?string $bankID = null,
        ?string $bankName = null,
        ?string $operator = null,
        ?string $phone = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountName'] = $accountName;
        $self['country'] = $country;
        $self['createdAt'] = $createdAt;
        $self['type'] = $type;

        null !== $accountNumber && $self['accountNumber'] = $accountNumber;
        null !== $bankID && $self['bankID'] = $bankID;
        null !== $bankName && $self['bankName'] = $bankName;
        null !== $operator && $self['operator'] = $operator;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * Recipient UUID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * Country code.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Transfer recipient type.
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
     * Bank account number (bank-account only).
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * Bank ID (bank-account only).
     */
    public function withBankID(string $bankID): self
    {
        $self = clone $this;
        $self['bankID'] = $bankID;

        return $self;
    }

    /**
     * Bank name (bank-account only).
     */
    public function withBankName(string $bankName): self
    {
        $self = clone $this;
        $self['bankName'] = $bankName;

        return $self;
    }

    /**
     * Mobile money operator (mobile-money only).
     */
    public function withOperator(string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * Phone number (mobile-money only).
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
