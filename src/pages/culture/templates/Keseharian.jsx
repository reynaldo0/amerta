// BlogSlider.tsx
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";

const blogPosts = [
  {
    date: "Wednesday, October 30, 2024",
    title: "A Pinterest University Recruiting event recap",
    description:
      "The University Recruiting team hosted an exciting event at our San Francisco headquarters to connect with students in the Bay Area.",
    image:
      "https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=900&q=80",
  },
  {
    date: "Friday, October 04, 2024",
    title: "Celebrating Latiné Heritage Month with Barbara Gonzalez",
    description:
      "A few months ago, we welcomed Barbara Gonzalez to the Pinterest Global Content team. Today, she's sharing more about her involvement.",
    image:
      "https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?auto=format&fit=crop&w=900&q=80",
  },
  {
    date: "Monday, September 23, 2024",
    title: "How Pinterest Designers find inspiration",
    description:
      "Our design team talks about where they look for inspiration and how they transform ideas into real projects at Pinterest.",
    image:
      "https://images.unsplash.com/photo-1506765515384-028b60a970df?auto=format&fit=crop&w=900&q=80",
  },
];

export default function BlogSlider() {
  return (
    <section className="max-w-7xl mx-auto px-6 py-16">
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-10 items-center">
        {/* Left Content */}
        <div className="lg:col-span-1">
          <h2 className="text-4xl font-extrabold leading-tight text-gray-900 mb-4">
            Life at Pinterest Blog
          </h2>
          <p className="text-gray-600 mb-6">
            Get to know your future teammates and immerse yourself in the magic
            behind bringing Pinterest to life.
          </p>
          <button className="px-6 py-3 rounded-full bg-black text-white font-semibold hover:bg-gray-800 transition">
            Explore the blog
          </button>

          {/* Custom Navigation */}
          <div className="flex gap-4 mt-10 text-gray-600">
            <button className="swiper-button-prev-custom w-10 h-10 rounded-full border flex items-center justify-center hover:bg-gray-100">
              ←
            </button>
            <button className="swiper-button-next-custom w-10 h-10 rounded-full border flex items-center justify-center hover:bg-gray-100">
              →
            </button>
          </div>
        </div>

        {/* Right Swiper */}
        <div className="lg:col-span-2">
          <Swiper
            modules={[Navigation]}
            navigation={{
              prevEl: ".swiper-button-prev-custom",
              nextEl: ".swiper-button-next-custom",
            }}
            spaceBetween={30}
            slidesPerView={1.2}
            breakpoints={{
              768: { slidesPerView: 2 },
              1024: { slidesPerView: 2.2 },
            }}
          >
            {blogPosts.map((post, i) => (
              <SwiperSlide key={i}>
                <div className="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                  <img
                    src={post.image}
                    alt={post.title}
                    className="w-full h-56 object-cover"
                  />
                  <div className="p-6">
                    <p className="text-sm text-gray-500 mb-2">{post.date}</p>
                    <h3 className="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                      {post.title}
                    </h3>
                    <p className="text-gray-600 text-sm mb-4 line-clamp-3">
                      {post.description}
                    </p>
                    <a
                      href="#"
                      className="text-sm font-semibold text-black hover:underline"
                    >
                      Read more →
                    </a>
                  </div>
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
        </div>
      </div>
    </section>
  );
}
 