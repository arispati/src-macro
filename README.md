# SRC Macro

**SRC Macro** merupakan package yang didalamnya terdapat kumpulan Macro untuk Laravel dan Lumen.

### Cara Install

- `composer require arispati/src-macro`

#### Laravel 

- Otomatis terdaftar oleh `Laravel Package Discovery`

#### Lumen

- Daftarkan service provider di `bootstrap/app.php`
	```php
	$app->register(Arispati\SrcMacro\ServiceProvider::class);
	``` 

### Macro yang tersedia

- **Database - Query Builder**
	- [onSearch](#dqb-onSearch)
	- [onSort](#dqb-onSort)
	- [onFilter](#dqb-onFilter)
	- [onBetWeen](#dqb-onBetween)

### Cara Penggunaan

- <a name="dqb-onSearch"></a> **onSearch**

    Pencarian berdasarkan kolom yang sudah ditetapkan

	```php
	onSearch(
		array $columns = [],
		// default query param dari front-end
		string $searchParam = 'search'
	)
	```

	contoh:
	
    ```php
	$query = DB::table('namaTabel')->onSearch([
		'namaTabel.id', 'nama'
	])
	```

- <a name="dqb-onSort"></a> **onSort**

    Order hasil query berdasarkan kolom yang sudah ditetapkan

	```php
	onSort(
		array $columns = [],
		// default query param dari front-end
		string $sortParam = 'sort',
		string $sortTypeParam = 'sort_type'
	)
	```

	contoh:
	
    ```php
	$query = DB::table('namaTabel')->onSort([
		'id',
		// dari query param => kolom pada query
		'nama' => 'namaTabel.nama'
	])
	```

- <a name="dqb-onFilter"></a> **onFilter**

    Filter query berdasarkan kolom dan value

	```php
	onFilter(array $columns) // kolom harus ditetapkan
	```

	contoh:
	
    ```php
	$query = DB::table('namaTabel')->onFilter([
		'id',
		// dari query param => kolom pada query
		'nama' => 'namaTabel.nama'
	])
	```

- <a name="dqb-onBetween"></a> **onBetween**

    Filter hasil berdasarkan dua tanggal yang ditetapkan

	```php
	onBetween(
		string $column = 'created_at',
		// default query param dari front-end
		string $startDateParam = 'start_date',
		string $endDateParam = 'end_date'
	)
	```

	contoh:
	
    ```php
	// jika parameter sesuai default
	$query = DB::table('namaTabel')->onBetween()
	```
