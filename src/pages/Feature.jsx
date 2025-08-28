import { useEffect, useState } from "react";

export default function FeaturesSection() {
  const [offsetY, setOffsetY] = useState(0);

  useEffect(() => {
    const handleScroll = () => setOffsetY(window.scrollY);
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

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
      <div
        className="absolute inset-0 bg-[url('/wave.svg')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />

      <div className="absolute top-0 w-full overflow-hidden leading-[0] z-20">
        <img
          src="/wave-top.svg"
          alt="Wave"
          className="w-full h-56 md:h-96 object-cover"
          style={{
            transform: `translateY(${Math.min(offsetY * 0.4 - 200, 0)}px)`,
            transition: "transform 0.15s ease-out",
          }}
        />
      </div>

      <div className="relative max-w-7xl mx-auto px-6 text-center z-20">
        {/* Title */}
        <h2
          className="text-4xl md:text-6xl font-extrabold text-[#84441E] mb-6 tracking-tight"
          style={{
            transform:
              offsetY > 500 
                ? `translateY(${(offsetY - 400) * 0.25}px) scale(${
                    1 + (offsetY - 200) * -0.0003
                  }) `
                : "translateY(30px) scale(0.98) rotate(0deg)",
            opacity: offsetY > 200 ? Math.min((offsetY - 200) / 200, 1) : 0,
            transition: "transform 0.8s ease-out, opacity 0.8s ease-out",
          }}
        >
          Jelajahi Kekayaan Budaya Nusantara
        </h2>

        <p
          className="text-[#84441E] mb-20 max-w-2xl mx-auto text-lg"
          style={{
            transform:
              offsetY > 250 
                ? `translateY(${(offsetY - 250) * 0.18}px) scale(${
                    1 + (offsetY - 250) * -0.0002
                  })`
                : "translateY(30px) scale(0.99)",
            opacity: offsetY > 250 ? Math.min((offsetY - 250) / 150, 1) : 0,
            transition: "transform 0.9s ease-out, opacity 0.9s ease-out",
          }}
        >
          Dari cerita rakyat, peta interaktif, hingga kuis budaya. Semua dalam
          satu ekosistem budaya digital.
        </p>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
          {features.map((feature, index) => (
            <div
              key={index}
              className="group relative rounded-2xl p-8 bg-white shadow-md border border-[#84441E]/40 
                         transition-all duration-500 ease-out cursor-pointer
                         hover:-translate-y-4 hover:scale-105 hover:rotate-1 hover:shadow-2xl hover:border-[#84441E]"
              style={{
                transform: `translateY(${offsetY * 0.08}px)`, 
              }}
            >
              <div className="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 bg-gradient-to-br from-[#84441E]/10 to-transparent blur-2xl transition duration-500"></div>

              <div className="relative z-10 text-5xl mb-6 text-[#84441E]">
                {feature.icon}
              </div>
              <h3 className="relative z-10 text-2xl font-bold text-[#84441E] mb-3">
                {feature.title}
              </h3>
              <p className="relative z-10 text-[#84441E]">{feature.desc}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
