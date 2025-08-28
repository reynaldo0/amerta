import Navbar from "./components/Navbar";
import FeaturesSection from "./pages/Feature";
import Hero from "./pages/Hero";
import Peta from "./pages/Peta";

function App() {
  return (
    <>
      <Navbar />
      <Hero />
      <FeaturesSection />
      <Peta />
      <div className="h-[500px] bg-white"></div>
    </>
  );
}

export default App;
