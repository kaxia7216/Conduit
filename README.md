Laravel Sailを使用して、"Conduit"を作成しました。

## 使用環境

- WSL2(Ubuntu)
- Docker

> [!IMPORTANT]  
> 環境構築に 'Laravel Sail' を使用していますので、起動する環境にDockerがインストールされている必要があります。  

## 起動方法

本リポジトリを任意のディレクトリにクローンします。
```
git clone https://github.com/kaxia7216/Conduit.git
```
conduitディレクトリに移動します。
```
cd Conduit
```

sail コマンドを入力します。
```
./vender/bin/sail up -d
```

[localhost](http://localhost) でブラウザに表示することができます。