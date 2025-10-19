# Laravel Clean DDD API

Clean ArchitectureとDomain-Driven Design（DDD）に基づいたLaravel APIサーバーです。

## 🏗️ アーキテクチャ

```
app/
├── Domain/                    # ビジネスルール（フレームワーク非依存）
│   ├── Models/                # Entity / ValueObject
│   └── Repositories/          # Repository Interface
│
├── Application/              # ユースケース（アプリケーションフロー）
│   ├── Controllers/          # APIコントローラ（外部I/O）
│   ├── Requests/             # 入力DTO（JSON）
│   ├── Responses/            # 出力DTO（JSON）
│   └── UseCases/             # UseCase, Structure, Requirement
│
├── Infrastructure/           # 技術的詳細（永続化・外部APIなど）
│   ├── Eloquent/            # ORMモデル
│   └── Repositories/        # Repository実装（Domain契約を実装）
│
└── Providers/               # DIバインド、ServiceProviderなど
```

## 🚀 クイックスタート

### 1. 開発環境の起動
```bash
# 開発環境を起動
make up

# データベースを初期化
make migrate

# APIの動作確認
make api-test
```

### 2. 開発作業
```bash
# コンテナ内のシェルに入る
make shell

# コントローラーを作成
make controller NAME="TodoListController"

# コード品質チェック
make check
```

## 📋 Makefileコマンド一覧

### 🐳 Dockerコンテナ管理
```bash
make up          # 開発環境を起動
make down        # 開発環境を停止
make restart     # 開発環境を再起動
make logs        # コンテナのログを表示
make build       # コンテナをビルド
make status      # コンテナの状態を表示
make shell       # コンテナ内のシェルに入る
```

### 🗄️ データベース操作
```bash
make migrate        # マイグレーションを実行
make migrate-fresh   # フレッシュマイグレーション（データリセット）
make rollback       # 最後のマイグレーションをロールバック
make seed          # シーダーを実行
```

### 🧪 APIテスト
```bash
make api-test       # APIエンドポイントをテスト
```

### 🔧 コード品質
```bash
make install-phpstan    # PHPStanとLarastanをインストール
make pint              # Laravel Pint（コードスタイル修正）
make phpstan           # PHPStan（静的解析）
make check             # 両方を実行（Pint + PHPStan）
```

### 📝 コントローラー作成
```bash
make controller NAME="TodoListController"    # コントローラーを作成
```

## 🛠️ 開発ワークフロー

### 日常の開発作業
```bash
# 1. 開発環境を起動
make up

# 2. 新しい機能を開発
make shell
# コンテナ内で作業...

# 3. データベースを更新
make migrate

# 4. コード品質をチェック
make check

# 5. APIをテスト
make api-test

# 6. 開発終了時
make down
```

### 新機能開発の流れ
```bash
# 1. コントローラーを作成
make controller NAME="ProductController"

# 2. 作成されたファイルをClean Architectureの構造に移動
mv app/Http/Controllers/ProductController.php app/Application/Controllers/

# 3. 必要に応じて以下を作成
# - Domain/Models/Product.php
# - Domain/Repositories/ProductRepositoryInterface.php
# - Application/UseCases/CreateProductUseCase.php
# - Infrastructure/Repositories/ProductRepository.php
```

## 🔍 トラブルシューティング

### よくある問題と解決方法

#### 1. アプリケーション名前空間検出エラー
```bash
# 環境変数を確認・設定
cat .env | grep APP_

# 設定をクリア
make shell
php artisan config:clear
php artisan cache:clear
```

#### 2. データベース接続エラー
```bash
# データベース設定を確認
grep -E "DB_" .env

# データベースを初期化
make migrate
```

#### 3. コンテナが起動しない
```bash
# コンテナの状態を確認
make status

# ログを確認
make logs

# コンテナを再ビルド
make build
```

## 📚 参考資料

- [Laravel Documentation](https://laravel.com/docs)
- [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
- [Domain-Driven Design](https://martinfowler.com/bliki/DomainDrivenDesign.html)

## 🤝 コントリビューション

1. このリポジトリをフォーク
2. フィーチャーブランチを作成 (`git checkout -b feature/amazing-feature`)
3. 変更をコミット (`git commit -m 'Add some amazing feature'`)
4. ブランチにプッシュ (`git push origin feature/amazing-feature`)
5. プルリクエストを作成

## 📄 ライセンス

このプロジェクトはMITライセンスの下で公開されています。