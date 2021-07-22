<?php
declare(strict_types = 1);

namespace FioApi;

class PaymentOrderEuro extends PaymentOrderForeign
{
    use Symbols;

    public const PAYMENT_TYPE_STANDARD = 431008;
    public const PAYMENT_TYPE_PRIORITY = 431009;

    protected const PAYMENT_TYPES = [self::PAYMENT_TYPE_STANDARD, self::PAYMENT_TYPE_PRIORITY];

    protected int $paymentType;


    public function __construct(
        string $currency,
        float $amount,
        string $accountTo,
        \DateTimeInterface $date,
        string $benefName,
        ?string $benefStreet = null,
        ?string $benefCity = null,
        ?string $benefCountry = null,
        ?string $constantSymbol = null,
        ?string $variableSymbol = null,
        ?string $specificSymbol = null,
        ?string $bic = null,
        ?string $comment = null,
        ?string $remittanceInfo1 = null,
        ?string $remittanceInfo2 = null,
        ?string $remittanceInfo3 = null,
        ?int $paymentReason = null,
        ?int $paymentType = null
    ) {
        parent::__construct($currency, $amount, $accountTo, $date, $benefName, $comment, $remittanceInfo2, $remittanceInfo3);

        if ($benefStreet !== null) {
            $this->setBenefStreet($benefStreet);
        }
        if ($benefCity !== null) {
            $this->setBenefCity($benefCity);
        }
        if ($benefCountry !== null) {
            $this->setBenefCountry($benefCountry);
        }
        if ($constantSymbol !== null) {
            $this->setConstantSymbol($constantSymbol);
        }
        if ($variableSymbol !== null) {
            $this->setVariableSymbol($variableSymbol);
        }
        if ($specificSymbol !== null) {
            $this->setSpecificSymbol($specificSymbol);
        }
        if ($bic !== null) {
            $this->setBic($bic);
        }
        if ($remittanceInfo1 !== null) {
            $this->setRemittanceInfo1($remittanceInfo1);
        }
        if ($paymentReason !== null) {
            $this->setPaymentReason($paymentReason);
        }
        if ($paymentType !== null) {
            $this->setPaymentType($paymentType);
        }
    }

    public function toArray(): array {
        return array_merge(parent::toArray(), $this->symbolsToArray(), [
            'paymentType' => $this->paymentType ?? null,
        ]);
    }

    /** @return static */
    protected function setPaymentType(int $type)
    {
        $this->paymentType = static::validateValueIsInList($type, static::PAYMENT_TYPES);
        return $this;
    }
}
