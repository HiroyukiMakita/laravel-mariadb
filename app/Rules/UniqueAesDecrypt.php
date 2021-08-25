<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

use function app\Helpers\decrypt_column;

class UniqueAesDecrypt implements Rule
{
    /** @var string */
    private $tableName;
    /** @var string|null */
    private $columnName;
    /** @var string|null */
    private $ignoreId;

    /**
     * Create a new rule instance.
     *
     * @param string $tableName
     * @param string|null $columnName
     * @param string|null $ignoreId
     * @return void
     */
    public function __construct(
        string $tableName,
        string $columnName = null,
        string $ignoreId = null
    ) {
        $this->tableName = $tableName;
        $this->columnName = $columnName;
        $this->ignoreId = $ignoreId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $modelName = STR::studly(Str::singular($this->tableName));
        $className = 'App\\Models\\' . $modelName;
        $model = new $className;
        $column = $this->columnName ?? $attribute;

        // 既存のデータを複合化したものと入力値が一致している
        $query = $model::whereRaw(decrypt_column($column) . ' = ?', [$value]);

        // 第三引数がある場合は、そのIDをユニークチェックの対象から除外する。
        if (isset($this->ignoreId)) {
            $query->where('id', '!=', $this->ignoreId);
        }

        return !$query->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return '指定の:attributeは既に使用されています。';
    }
}
