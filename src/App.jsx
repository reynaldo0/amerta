import Navbar from "./components/Navbar";
import FeaturesSection from "./pages/Feature";
import Hero from "./pages/Hero";

function App() {
  return (
    <>
      <Navbar />
      <Hero />
      <FeaturesSection />
      <div className="h-[500px] bg-white"></div>
    </>
  );
}

export default App;
