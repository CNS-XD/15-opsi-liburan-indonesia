// Fungsi untuk menghasilkan hash dari sebuah string
function stringToHash(string) {
    let hash = 0;
    for (let i = 0; i < string.length; i++) {
        const char = string.charCodeAt(i);
        hash = (hash << 5) - hash + char;
        hash |= 0; // Konversi ke 32-bit integer
    }
    return hash;
}

// Fungsi untuk menghasilkan warna RGB cenderung gelap
function hashToColor(hash) {
    // Batasi nilai maksimum RGB pada 150 untuk menghasilkan warna gelap
    const r = Math.abs((hash & 0xFF0000) >> 16) % 150;
    const g = Math.abs((hash & 0x00FF00) >> 8) % 150;
    const b = Math.abs(hash & 0x0000FF) % 150;
    return `rgb(${r}, ${g}, ${b})`;
}