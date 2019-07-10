for file in *.png
do
    cwebp -q 100 -lossless "$file" -o "${file%.*}.webp"
done
