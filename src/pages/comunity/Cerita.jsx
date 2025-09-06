import { useEffect, useState, useRef } from "react";

const stories = [
  {
    id: 1,
    title: "Dewi Sri",
    content: `
Dahulu kala, hiduplah seorang putri yang cantik jelita bernama Dewi Sri.
Ia dikenal sebagai dewi kesuburan yang membawa kemakmuran bagi rakyat.
Namun, suatu ketika kerajaan dilanda kekeringan yang panjang...
(Lanjutan cerita bisa diperpanjang sesuai kebutuhan)
Dahulu kala, hiduplah seorang putri yang cantik jelita bernama Dewi Sri.
Ia dikenal sebagai dewi kesuburan yang membawa kemakmuran bagi rakyat.
    `,
  },
  {
    id: 2,
    title: "Malin Kundang",
    content: `
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya. Namun ketika pulang,
ia malu mengakui ibunya sendiri. Akhirnya ia dikutuk menjadi batu...
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya.
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya. Namun ketika pulang,
ia malu mengakui ibunya sendiri. Akhirnya ia dikutuk menjadi batu...
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya.
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya. Namun ketika pulang,
ia malu mengakui ibunya sendiri. Akhirnya ia dikutuk menjadi batu...
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya.
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya. Namun ketika pulang,
ia malu mengakui ibunya sendiri. Akhirnya ia dikutuk menjadi batu...
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya.
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya. Namun ketika pulang,
ia malu mengakui ibunya sendiri. Akhirnya ia dikutuk menjadi batu...
Dahulu kala, hiduplah seorang anak bernama Malin Kundang.
Ia pergi merantau dan menjadi kaya raya.
    `,
  },
];

// Fungsi untuk membuat excerpt otomatis
const getExcerpt = (text, length = 120) => {
  const cleanText = text.replace(/\s+/g, " ").trim(); // hapus spasi ekstra
  if (cleanText.length <= length) return cleanText;
  return cleanText.slice(0, length) + "...";
};

export default function CeritaRakyat() {
  const [points, setPoints] = useState(0);
  const [selectedStory, setSelectedStory] = useState(null);
  const [scrollProgress, setScrollProgress] = useState(0);
  const [hasRead, setHasRead] = useState(false);

  const storyRef = useRef(null);

  // Scroll progress & poin
  useEffect(() => {
    if (!storyRef.current) return;

    const element = storyRef.current;

    const handleScroll = () => {
      const { scrollTop, scrollHeight, clientHeight } = element;
      const progress = (scrollTop / (scrollHeight - clientHeight)) * 100;
      setScrollProgress(progress);

      if (progress >= 95 && !hasRead) {
        setPoints((prev) => prev + 10);
        setHasRead(true);
      }
    };

    element.addEventListener("scroll", handleScroll, { passive: true });

    return () => {
      element.removeEventListener("scroll", handleScroll);
    };
  }, [hasRead, selectedStory]);

  return (
    <div className="min-h-screen bg-white relative">
      {/* Background */}
      <div
        className="absolute inset-0 bg-[url('/wave/komunitas.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <img
        src="/wave/forum.png"
        alt="Wave"
        className="w-full opacity-100 h-full object-cover will-change-transform"
      />

      <h1 className="text-4xl md:text-6xl font-extrabold text-center text-primary-200 mb-8 relative z-10">
        Cerita Rakyat Interaktif
      </h1>

      {/* Card selection */}
      {!selectedStory && (
        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto py-24 relative z-10">
          {stories.map((story) => (
            <div
              key={story.id}
              onClick={() => {
                setSelectedStory(story);
                setHasRead(false);
                setScrollProgress(0);
              }}
              className="cursor-pointer bg-white rounded-2xl shadow-md hover:shadow-2xl transition-transform hover:-translate-y-1 p-6 flex flex-col justify-between"
            >
              <div>
                <h2 className="text-2xl font-semibold text-primary-200">
                  {story.title}
                </h2>
                <p className="text-gray-600 mt-3">
                  {getExcerpt(story.content)}
                </p>
              </div>
              <p className="mt-4 text-sm text-gray-400 italic text-right">
                Klik untuk membaca →
              </p>
            </div>
          ))}
        </div>
      )}

      {/* Selected story */}
      {selectedStory && (
        <div className="max-w-6xl mx-auto grid md:grid-cols-4 gap-6 py-24 relative z-10">
          <div className="col-span-3 bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col">
            <div className="bg-gradient-to-r from-secondary-300 via-secondary-200 to-secondary-300 p-6 text-white">
              <h2 className="text-3xl font-bold">{selectedStory.title}</h2>
              <p className="opacity-90 mt-1">
                Baca sampai selesai untuk dapatkan poin!
              </p>
            </div>

            <div
              ref={storyRef}
              className="p-8 h-[400px] overflow-y-auto text-gray-800 leading-relaxed text-lg scroll-smooth"
            >
              <p className="whitespace-pre-line">{selectedStory.content}</p>
              {!hasRead && (
                <div className="flex justify-center mt-8 animate-bounce text-gray-400">
                  ⬇️ Gulir terus ke bawah
                </div>
              )}
            </div>

            <div className="relative h-2 bg-gray-200">
              <div
                className="absolute top-0 left-0 h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 transition-all duration-300"
                style={{ width: `${scrollProgress}%` }}
              />
            </div>

            <div className="p-6 flex items-center justify-between">
              <button
                onClick={() => setSelectedStory(null)}
                className="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-gray-600"
              >
                ← Kembali
              </button>

              <div className="text-right">
                <h3 className="text-xl font-semibold text-indigo-600">
                  🎯 Poin Kamu: {points}
                </h3>
                {hasRead && (
                  <p className="text-green-600 font-medium mt-1 animate-pulse">
                    🎉 +10 Poin berhasil ditambahkan!
                  </p>
                )}
              </div>
            </div>
          </div>

          <div className="bg-white rounded-2xl shadow-xl p-6 flex flex-col justify-between">
            <div>
              <h2 className="text-xl font-semibold text-gray-800">
                📊 Total Poin
              </h2>
              <p className="text-4xl font-bold text-indigo-600 mt-2">
                {points}
              </p>
            </div>
            <div className="mt-4 text-gray-400 italic text-center">
              Gulir cerita sampai selesai untuk mendapatkan poin
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
