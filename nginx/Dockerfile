FROM nginx:1.26-alpine

# 1プロセスでosによっては1024個までしかファイルディスクリプタをひらけない設定になっている可能性があるため設定を書き換える必要がある場合もある。
# ベストプラクティス的に必要なものだけをインストールする
RUN apk update \
    && apk upgrade \
    && apk --update add logrotate \
    && apk add --no-cache openssl