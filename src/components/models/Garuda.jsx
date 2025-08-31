import React, { useRef, Suspense } from "react";
import { useGLTF, Html } from "@react-three/drei";
import { useFrame } from "@react-three/fiber";

function Garuda(props) {
  const { nodes, materials } = useGLTF("/models/garuda.glb");

  // Reference to the model group
  const modelRef = useRef();

  // Rotate the model
  useFrame(() => {
    if (modelRef.current) {
      modelRef.current.rotation.y += 0.01; // Rotate around Y-axis
    }
  });

  return (
    <group {...props} dispose={null} ref={modelRef}>
      <group position={[-0.153, 1.099, 0.239]} scale={0.485}>
        {[...Array(16)].map((_, index) => (
          <mesh
            key={index}
            castShadow
            receiveShadow
            geometry={nodes[`Object_${index + 4}`]?.geometry}
            material={materials.GARUDA_MATERIAL}
          />
        ))}
      </group>
      <mesh
        castShadow
        receiveShadow
        geometry={nodes.Object_18.geometry}
        material={materials.Gold_Damaged}
        position={[-0.019, 0.633, 0.426]}
        rotation={[1.708, -0.008, 0.002]}
        scale={0.214}
      />
    </group>
  );
}

function GarudaLoader() {
  return (
    <Suspense
      fallback={
        <Html center>
          <div className="relative">
            <div className="absolute bottom-2 md:top-5 -left-5 md:left-0 flex flex-col items-center justify-center text-white md:text-black">
              <div className="w-10 h-10 border-4 border-t-transparent border-white md:border-black rounded-full animate-spin"></div>
              <p className="mt-4 text-sm font-semibold">Loading Garuda...</p>
            </div>
          </div>
        </Html>
      }
    >
      <Garuda />
    </Suspense>
  );
}

useGLTF.preload("/models/garuda.glb");

export default GarudaLoader;
