import { useEffect, useRef, useState } from "react";

export default function Features() {
  const [offsetY, setOffsetY] = useState(0);
  const smoothOffsetY = useRef(0);
  const frame = useRef(null);

  // refs ke elemen yang mau dianimasikan
  const waveRef = useRef(null);
  const titleRef = useRef(null);
  const descRef = useRef(null);
  const cardsRef = useRef([]);

  useEffect(() => {
    const handleScroll = () => setOffsetY(window.scrollY);
    window.addEventListener("scroll", handleScroll, { passive: true });

    const animate = () => {
      // lerp smoothing
      smoothOffsetY.current += (offsetY - smoothOffsetY.current) * 0.08;

      const y = smoothOffsetY.current;

      // Wave atas
      if (waveRef.current) {
        waveRef.current.style.transform = `translateY(${Math.min(
          y * 0.4 - 200,
          0
        )}px)`;
      }

      // Title
      if (titleRef.current) {
        titleRef.current.style.transform =
          y > 500
            ? `translateY(${(y - 400) * 0.25}px) scale(${
                1 + (y - 200) * -0.0003
              })`
            : "translateY(30px) scale(0.98)";
        titleRef.current.style.opacity =
          y > 200 ? Math.min((y - 200) / 200, 1) : 0;
      }

      // Description
      if (descRef.current) {
        descRef.current.style.transform =
          y > 250
            ? `translateY(${(y - 250) * 0.18}px) scale(${
                1 + (y - 250) * -0.0002
              })`
            : "translateY(30px) scale(0.99)";
        descRef.current.style.opacity =
          y > 250 ? Math.min((y - 250) / 150, 1) : 0;
      }

      // Cards
      cardsRef.current.forEach((card, index) => {
        if (!card) return;
        const depth = (index % 3) * 15 + 10;
        const translateY =
          typeof window !== "undefined" && window.innerWidth < 768
            ? y * 0.08
            : y * (depth / 300);
        card.style.transform = `translateY(${translateY}px)`;
      });

      frame.current = requestAnimationFrame(animate);
    };

    frame.current = requestAnimationFrame(animate);
    return () => {
      window.removeEventListener("scroll", handleScroll);
      cancelAnimationFrame(frame.current);
    };
  }, [offsetY]);

  const features = [
    {
      title: "Peta Interaktif",
      desc: "Jelajahi budaya tiap provinsi lewat peta digital yang hidup.",
      icon: "🌏",
    },
    {
      title: "Kuis Budaya",
      desc: "Uji pengetahuanmu tentang budaya nusantara, dapatkan sertifikat digital.",
      icon: "❓",
    },
    {
      title: "AI Budaya",
      desc: "Tanya apa saja tentang budaya, asisten AI siap menjawab dengan referensi.",
      icon: "🤖",
    },
    {
      title: "Cerita Rakyat",
      desc: "Baca dan dengarkan dongeng klasik dari berbagai daerah Indonesia.",
      icon: "📖",
    },
    {
      title: "Galeri Multimedia",
      desc: "Nikmati foto 360°, video dokumenter, dan animasi 3D pakaian adat.",
      icon: "🎥",
    },
    {
      title: "Event Budaya",
      desc: "Ikuti festival, seminar, dan live streaming budaya dari seluruh Indonesia.",
      icon: "🎉",
    },
  ];

  return (
    <section className="relative py-40 bg-white overflow-hidden">
      {/* Background SVG */}
      {/* wave  bawah*/}
      <div className="absolute bottom-0 w-full overflow-hidden leading-[0] will-change-transform">
        <img
          src="/wave/FeatureB.png"
          alt="Wave"
          className="w-full h-full object-cover will-change-transform"
        />
      </div>
      <div
        className="absolute inset-0 bg-[url('/wave/bg.svg')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />

      {/* Wave atas */}
      <div className="absolute top-0 w-full overflow-hidden leading-[0] z-20 will-change-transform">
        <img
          ref={waveRef}
          src="/wave/feature.png"
          alt="Wave"
          className="w-full h-full object-cover will-change-transform"
        />
      </div>


      <div className="relative max-w-7xl mx-auto px-6 text-center z-20">
        {/* Title */}
        <h2
          ref={titleRef}
          className="text-4xl md:text-6xl font-extrabold text-primary-100 mb-6 tracking-tight will-change-transform"
        >
          Jelajahi Kekayaan Budaya Nusantara
        </h2>

        <p
          ref={descRef}
          className="text-primary-100 mb-20 max-w-2xl mx-auto text-lg will-change-transform"
        >
          Dari cerita rakyat, peta interaktif, hingga kuis budaya. Semua dalam
          satu ekosistem budaya digital.
        </p>

        {/* Cards */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-8 pb-10">
          {features.map((feature, index) => (
            <div
              key={index}
              ref={(el) => (cardsRef.current[index] = el)}
              className="group relative rounded-2xl p-8 bg-white shadow-md border border-primary-100/40 
                       transition-all duration-500 ease-out cursor-pointer
                       hover:-translate-y-4 hover:scale-105 hover:rotate-1 hover:shadow-2xl hover:border-primary-100 will-change-transform"
            >
              {/* Glow Hover */}
              <div className="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 bg-gradient-to-br from-[#84441E]/20 to-transparent blur-2xl transition duration-500"></div>

              {/* Icon */}
              <div className="relative z-10 text-5xl mb-6 text-primary-100">
                {feature.icon}
              </div>
              <h3 className="relative z-10 text-2xl font-bold text-primary-100 mb-3">
                {feature.title}
              </h3>
              <p className="relative z-10 text-primary-100">{feature.desc}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
