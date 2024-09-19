const slugify = (text) => {
        return text.trim()
            .toLowerCase()
            .replace(/\s+/g, '-')        // Ganti semua spasi dengan "-"
            .replace(/[^\w\-]+/g, '')    // Hapus semua karakter non-alphanumeric (selain tanda "-")
            .replace(/-+/g, '-')         // Ganti "-" yang berulang dengan satu "-"
            .replace(/^-|-$/g, '');      // Hapus tanda "-" di awal atau akhir teks
    };