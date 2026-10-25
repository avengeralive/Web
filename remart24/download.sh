#! /usr/bin/env bash
echo $(pwd);
git archive -o ../qbit_update/diff_$1_$2.zip $1 $(git diff --name-only $2 $1 );
echo "test";
