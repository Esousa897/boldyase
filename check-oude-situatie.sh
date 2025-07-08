#!/bin/bash

echo ""
echo "┌───────────────────────────────────────────┐"
echo "│   BOLDYASE | Snapshot oude situatie       │"
echo "└───────────────────────────────────────────┘"
echo ""

echo "Bestanden & mappen in deze directory:"
ls -lh --group-directories-first
echo ""

# Oude bestanden checken en inhoud tonen (indien aanwezig)
for file in index.php dashboard.php config.php; do
    if [ -f "$file" ]; then
        echo "✔️  Gevonden: $file"
        echo "--- Inhoud van $file:"
        head -10 "$file"
        echo "---------------------------"
    else
        echo "❌  Ontbreekt: $file"
    fi
    echo ""
done

echo "Snapshot klaar. Je kunt deze output bewaren!"