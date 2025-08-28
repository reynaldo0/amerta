import { useEffect, useState } from "react";

export default function Hero() {
  const [offsetY, setOffsetY] = useState(0);

  useEffect(() => {
    const handleScroll = () => setOffsetY(window.scrollY);
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  return (
    <section className="relative h-screen w-full bg-white overflow-hidden">
      <div
        className="absolute inset-0 bg-[url('/wave.svg')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      {/* Background Layer + Blur */}
      <div
        className="absolute inset-0 bg-cover bg-center"
        style={{
          transform: `translateY(${offsetY * 0.5}px)`,
          filter: `blur(${Math.min(offsetY * 0.02, 10)}px)`,
          transition: "transform 0.1s ease-out, filter 0.1s ease-out",
        }}
      />

      {/* Overlay Gelap */}
      {/* <div className="absolute inset-0 bg-black/40" /> */}

      {/* Parallax Object 1 */}
      <div
        className="absolute left-0 top-1/3 w-48 h-48 bg-[#84441E] rounded-full opacity-70"
        style={{
          transform: `translateX(${offsetY * 0.4}px) translateY(${
            offsetY * 0.2
          }px)`,
          filter: `blur(${Math.min(offsetY * 0.015, 6)}px)`,
        }}
      />

      {/* Parallax Object 2 */}
      <div
        className="absolute right-0 top-1/2 w-56 h-56 bg-[#84441E] rounded-full opacity-70"
        style={{
          transform: `translateX(-${offsetY * 0.5}px) translateY(${
            offsetY * 0.3
          }px)`,
          filter: `blur(${Math.min(offsetY * 0.015, 6)}px)`,
        }}
      />

      {/* Text Layer */}
      <div
        className="relative z-10 flex flex-col justify-center items-center h-full text-center px-4"
        style={{
          transform: `translateY(${offsetY * 0.6}px)`,
          transition: "transform 0.1s ease-out",
        }}
      >
        <h1 className="text-5xl md:text-6xl font-extrabold tracking-wide">
          Keindahan Budaya Nusantara
        </h1>
        <p className="mt-6 text-lg md:text-2xl max-w-2xl">
          Menyelami ragam budaya dan tradisi yang membentuk identitas bangsa.
        </p>
      </div>

      {/* Wave Parallax */}
      {/* Wave Parallax */}
      <div className="absolute bottom-0 w-full overflow-hidden leading-[0] z-20">
        <img
          src="/wave.svg"
          alt="Wave"
          className="w-full h-56 md:h-72 object-cover"
          style={{
            transform:
              offsetY > 0
                ? `translateY(${offsetY * 0.5}px)` // Hapus Math.min supaya bisa terus turun
                : "translateY(0)",
            transition: "transform 0.15s ease-out",
          }}
        />
      </div>
    </section>
  );
}
